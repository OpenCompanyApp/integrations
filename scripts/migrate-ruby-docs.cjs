/**
 * One-time, AST-based migration of repository-owned examples, NOT stored scripts.
 * Unknown syntax fails closed. This tool has no database, provider or execution
 * access; all output still requires engine admission and catalog conformance.
 * Usage: node scripts/migrate-ruby-docs.cjs /path/to/reviewed-js-docs-checkout
 */
const fs = require('node:fs');
const path = require('node:path');
const parser = require('@babel/parser');
const root = path.resolve(__dirname, '..');
const source = path.resolve(process.argv[2] || '');
if (!process.argv[2] || source === root) throw new Error('Provide a separate source checkout');
const {execFileSync} = require('node:child_process');
if (!process.argv[3]) throw new Error('Pass a host Composer autoloader as the second argument');
const catalog = JSON.parse(execFileSync('php', [path.join(__dirname, 'export-script-catalog.php'), process.argv[3]], {maxBuffer: 32 * 1024 * 1024}));
const providers = new Map(catalog.integrations.map(p => [p.package, p]));
let blocks = 0, files = 0;
// Reviewed Ruby pages are authored against current provider contracts. Preserve
// them on subsequent legacy-conversion runs; validation still compiles all Ruby
// pages independently. The checked-in inventory is populated only after review.
const reviewedInventory = path.join(__dirname, 'reviewed-ruby-docs.json');
const reviewedDocuments = new Set(fs.existsSync(reviewedInventory)
  ? JSON.parse(fs.readFileSync(reviewedInventory, 'utf8')) : []);
const unresolved = new Set();
const rubyString = value => JSON.stringify(value).replace(/#(?=[{@$])/g, '\\#');
// Reviewed against the named source tool's parameter and endpoint contract.
// These repairs apply only to repository examples, never user-owned scripts.
const reviewedCalls = {
  'dbt-cloud:v3_retrieve_job': 'dbt_cloud_v2_retrieve_job',
  'eden-ai:api_post': 'edenai_api_post',
  'vonage:list_sms': 'vonage_list_messages',
  'workos:workos_user_management_users_get': 'workos_userland_users_get_0',
  'x:x_find_my_user': 'x_get_users_me',
};
const derive = (name, app) => {
  const snake = name.toLowerCase().trim().replace(/[^a-z0-9]+/g, '_').replace(/^_|_$/g, '');
  const base = app.toLowerCase().replace(/s+$/, '');
  const words = snake.split('_').filter(w => !['on','of','for','in','to','the','a','an'].includes(w)
    && !w.replace(/s+$/, '').includes(base) && !base.includes(w.replace(/s+$/, '')));
  const result = words.join('_') || snake || 'tool';
  return /^\d/.test(result) ? '_' + result : result;
};

function convert(code, provider, filename) {
  // These reviewed repairs address malformed legacy examples, not source-language
  // inference. Time-dependent examples take explicit input; secrets are not logged.
  code = code.replaceAll("'String.raw`\"visitors\", \"desc\"`'", "'[[\"visitors\",\"desc\"]]'" )
    .replaceAll("'String.raw`\"pageviews\", \"desc\"`'", "'[[\"pageviews\",\"desc\"]]'" )
    .replaceAll("'String.raw`\"is\", \"visit:country\", [\"US\"`]'", "'[[\"is\",\"visit:country\",[\"US\"]]]'" )
    .replaceAll("'String.raw`\"contains\", \"event:page\", [\"/blog\"`]'", "'[[\"contains\",\"event:page\",[\"/blog\"]]]'" )
    .replaceAll('String.raw`,\n', 'String.raw`\n')
    .replaceAll('new Date(result.data.created_utc * 1000).toISOString().slice(0, 10)', 'result.data.created_utc')
    .replaceAll('"Created: "', '"Created (Unix seconds): "')
    .replaceAll('console.log("DSN: " + dsn)', 'console.log("Credentials loaded; connection string intentionally not logged")');
  if (provider?.package === 'workos') {
    code = code.replace(/(workos_user_management_users_get\(\{\s*)user_id:/g, '$1id:');
  }
  const ast = parser.parse(code, {allowReturnOutsideFunction: true});
  const aliases = new Map();
  const localVariables = new Set();
  for (const stmt of ast.program.body) if (stmt.type === 'VariableDeclaration')
    for (const d of stmt.declarations) if (d.id.type === 'Identifier') localVariables.add(d.id.name);
  let usesTime = false;
  function member(n) {
    if (n.type === 'Identifier') return n.name;
    if (n.type === 'MemberExpression' && (!n.computed || n.property.type === 'StringLiteral')) return member(n.object) + '.' + (n.property.name ?? n.property.value);
    return '';
  }
  function callPath(name) {
    const segments = name.split('.');
    const last = segments.pop();
    if (last.endsWith('function_name')) return null;
    const owner = name.startsWith('app.integrations.')
      ? catalog.integrations.find(p => p.package === provider?.package && [p.slug, p.slug.replaceAll('-', '_'), p.slug.replaceAll('_', '-')].includes(segments[2]))
        || catalog.integrations.find(p => [p.slug, p.slug.replaceAll('-', '_'), p.slug.replaceAll('_', '-')].includes(segments[2]))
        || catalog.integrations.find(p => p.package === segments[2]) || provider
      : provider;
    const reviewed = reviewedCalls[`${owner?.package}:${last}`];
    let tool = owner?.tools.find(t => t.slug === (reviewed || last));
    if (reviewed && !tool) throw new Error(`Reviewed target no longer exists: ${reviewed}`);
    if (!tool) {
      const matches = owner?.tools.filter(t => [t.function_name, t.slug.replace(owner.slug.replaceAll('-', '_') + '_', ''), derive(t.name, owner.slug)].includes(last)) || [];
      if (matches.length === 1) tool = matches[0];
    }
    if (!tool) {
      const matches = owner?.tools.filter(t => t.slug.endsWith('_' + last)) || [];
      if (matches.length === 1) tool = matches[0];
    }
    const app = owner?.slug || path.basename(path.dirname(path.dirname(filename)));
    if (!tool) {
      unresolved.add(`${filename}: ${name}`);
      return name.startsWith('app.') ? name : `app.integrations.${app}.${last}`;
    }
    let account = '';
    if (name.startsWith('app.integrations.')) account = segments.slice(3).join('.');
    if (/^ns_/.test(segments[0])) account = segments[0].replace(new RegExp(`^ns_${app}_`), '');
    return `app.integrations.${app}.${account ? account + '.' : ''}${tool.function_name}`;
  }
  function expr(n, objectArguments = false) {
    if (!n) return 'nil';
    switch (n.type) {
      case 'Identifier': return n.name === 'undefined' ? 'nil'
        : /^(self|next|retry|redo|begin|end|class|module|def|alias|and|or|not|then|unless|until|when|case|else|elsif|ensure|rescue|yield|super|return|break|do|while|for|in|if|defined)$/.test(n.name) ? n.name + '_value' : n.name;
      case 'StringLiteral': return rubyString(n.value);
      case 'NumericLiteral': return String(n.value);
      case 'BooleanLiteral': return String(n.value);
      case 'NullLiteral': return 'nil';
      case 'ArrayExpression': return '[' + n.elements.map(x => expr(x)).join(', ') + ']';
      case 'ArrayPattern': return n.elements.map(x => expr(x)).join(', ');
      case 'ObjectExpression': {
        const pairs = n.properties.map(p => {
          if (p.type !== 'ObjectProperty') throw new Error('Unsupported object property');
          if (p.computed) return `${expr(p.key)} => ${expr(p.value)}`;
          const rawKey = p.key.name ?? p.key.value;
          const key = objectArguments ? rawKey.replace(/([a-z0-9])([A-Z])/g, '$1_$2').toLowerCase() : rawKey;
          return (/^[a-zA-Z_][a-zA-Z0-9_]*$/.test(key) ? key : rubyString(key)) + ': ' + expr(p.value);
        });
        return objectArguments && !n.properties.some(p => p.computed) ? pairs.join(', ') : '{' + pairs.join(', ') + '}';
      }
      case 'MemberExpression':
      case 'OptionalMemberExpression': {
        const op = n.optional ? '&.' : '.';
        return n.computed ? `${expr(n.object)}${n.optional ? '&.[](' : '['}${expr(n.property)}${n.optional ? ')' : ']'}`
          : `${expr(n.object)}${op}${n.property.name}`;
      }
      case 'UnaryExpression': return `(${n.operator}${expr(n.argument)})`;
      case 'AssignmentExpression': return `${expr(n.left)} ${n.operator} ${expr(n.right)}`;
      case 'BinaryExpression': {
        if (n.operator === '+') {
          const parts = [];
          const flatten = x => x.type === 'BinaryExpression' && x.operator === '+' ? (flatten(x.left), flatten(x.right)) : parts.push(x);
          flatten(n);
          if (parts.some(x => x.type === 'StringLiteral')) return parts.map(x => x.type === 'StringLiteral' ? expr(x) : `(${expr(x)}).to_s`).join(' + ');
        }
        return `(${expr(n.left)} ${{'===':'==','!==':'!='}[n.operator] || n.operator} ${expr(n.right)})`;
      }
      case 'LogicalExpression': return `(${expr(n.left)} ${n.operator} ${expr(n.right)})`;
      case 'TaggedTemplateExpression':
        if (member(n.tag) !== 'String.raw' || n.quasi.expressions.length) throw new Error('Unsupported template');
        return rubyString(n.quasi.quasis.map(q => q.value.raw).join(''));
      case 'CallExpression': {
        const name = member(n.callee), args = n.arguments.map(x => expr(x));
        if (name === 'console.log') return `puts(${args.join(', ')})`;
        if (['JSON.stringify','json.stringify','vim.inspect'].includes(name)) return `JSON.generate(${args.join(', ')})`;
        if (name === 'JSON.parse') return `JSON.parse(${args.join(', ')})`;
        if (name === 'Date.now') { usesTime = true; return '(example_unix_seconds * 1000)'; }
        if (name === 'Math.floor') return `(${args[0]}).floor`;
        if (name === 'String') return `(${args[0]}).to_s`;
        if (name === 'Number') return `(${args[0]}).to_f`;
        if (name === 'Array.from') return args[0];
        if (['Object.entries','Object.values','Object.keys'].includes(name)) return `${args[0]}.${{entries:'to_a',values:'values',keys:'keys'}[name.split('.')[1]]}`;
        if (name === 'string.format') {
          let index = 1;
          return n.arguments[0].value.split(/%[sd]/).map((part, i) => (i ? `(${args[index++ - 1]}).to_s + ` : '') + rubyString(part)).join(' + ');
        }
        if (n.callee.type === 'MemberExpression') {
          const method = n.callee.property.name;
          if (method === 'toISOString') { usesTime = true; return rubyString('2026-01-01T00:00:00Z'); }
          if (method === 'match' && n.arguments[0]?.value === '^[^\n]+') return `${expr(n.callee.object)}.split("\\n")`;
          if (method === 'slice') return `${expr(n.callee.object)}[${args[0]}...${args[1]}]`;
          if (method === 'entries') return `${expr(n.callee.object)}.each_with_index.map { |value, index| [index, value] }`;
          if (['toLowerCase','includes','push','join'].includes(method)) {
            const receiver = n.callee.object.type === 'ObjectExpression' && !n.callee.object.properties.length ? '[]' : expr(n.callee.object);
            return `${receiver}.${{toLowerCase:'downcase',includes:'include?',push:'push',join:'join'}[method]}(${args.join(', ')})`;
          }
        }
        if (name.startsWith('app.') || name.startsWith('tools.') || name.startsWith('ns_') || name.startsWith(provider?.slug.replaceAll('-', '_') + '_')
            || (name && !localVariables.has(name.split('.')[0]) && (name.split('.')[0] === provider?.slug.replaceAll('-', '_') || provider?.tools.some(t => [t.slug,t.function_name,derive(t.name,provider.slug)].includes(name.split('.').pop()))))) {
          const target = callPath(name);
          if (!target) return '# Discover the exact function and required parameters with code_read_doc.';
          const values = n.arguments.map((a, i) => expr(a, i === n.arguments.length - 1 && a.type === 'ObjectExpression')).join(', ');
          const reserved = /\b(?:send|include|class|method|display|inspect|extend|eval)\b/;
          return !/^[a-zA-Z_][\w]*(?:\.[a-zA-Z_]\w*)*$/.test(target) || reserved.test(target)
            ? `app.call(${rubyString(target.slice(4))}${values ? ', ' + values : ''})`
            : `${target}(${values})`;
        }
        throw new Error(`Unsupported call ${name || n.callee.type}`);
      }
      default: throw new Error(`Unsupported expression ${n.type}`);
    }
  }
  const indent = text => text.split('\n').map(l => '  ' + l).join('\n');
  function stmt(n) {
    const comments = (n.leadingComments || []).map(c => '# ' + c.value.trim().replace(/\n/g, '\n# ')).join('\n');
    let result;
    switch (n.type) {
      case 'VariableDeclaration': result = n.declarations.map(d => `${expr(d.id)} = ${expr(d.init)}`).join('\n'); break;
      case 'ExpressionStatement': result = expr(n.expression); break;
      case 'ReturnStatement': result = expr(n.argument); break;
      case 'BreakStatement': result = 'break'; break;
      case 'BlockStatement': result = n.body.map(stmt).join('\n'); break;
      case 'IfStatement': result = `if ${expr(n.test)}\n${indent(stmt(n.consequent))}${n.alternate ? '\nelse\n' + indent(stmt(n.alternate)) : ''}\nend`; break;
      case 'ForOfStatement': {
        const vars = expr(n.left.declarations[0].id);
        result = `${expr(n.right)}.each do |${vars}|\n${indent(stmt(n.body))}\nend`; break;
      }
      case 'DoWhileStatement': result = `# Bound pagination; persist the next cursor if more pages remain.\n10.times do\n${indent(stmt(n.body))}\n  break unless ${expr(n.test)}\nend`; break;
      default: throw new Error(`Unsupported statement ${n.type}`);
    }
    return comments ? comments + '\n' + result : result;
  }
  let output = ast.program.body.map(stmt).join('\n');
  if (!output && ast.comments.length) output = ast.comments.map(c => '# ' + c.value.trim()).join('\n');
  if (usesTime) output = '# Explicit example timestamp. Supply an appropriate timestamp as data; there is no ambient clock.\nexample_unix_seconds = 1767225600\n' + output;
  return output;
}

for (const directory of fs.readdirSync(path.join(source, 'packages')).sort()) {
  const dir = path.join(source, 'packages', directory, 'script-docs');
  if (!fs.existsSync(dir)) continue;
  for (const name of fs.readdirSync(dir).filter(n => n.endsWith('.md'))) {
    const relative = `packages/${directory}/script-docs/${name}`;
    if (reviewedDocuments.has(relative)) {
      const existing = fs.readFileSync(path.join(root, relative), 'utf8');
      if (/```(?:js|javascript|lua|luau)\b/.test(existing)) throw new Error(`Reviewed page contains legacy code: ${relative}`);
      blocks += [...existing.matchAll(/```ruby\n/g)].length;
      files++;
      continue;
    }
    const content = fs.readFileSync(path.join(source, relative), 'utf8');
    const converted = content.replace(/```(?:js|javascript)\n([\s\S]*?)```/g, (_, code) => {
      blocks++;
      try { return '```ruby\n' + convert(code, providers.get(directory), relative) + '\n```'; }
      catch (error) { throw new Error(`${relative} block ${blocks}: ${error.message}`); }
    }).replaceAll('JavaScript API', 'Ruby API').replaceAll('JavaScript', 'Ruby').replaceAll('QuickJS', 'mruby');
    const target = path.join(root, relative);
    fs.mkdirSync(path.dirname(target), {recursive: true});
    fs.writeFileSync(target, converted);
    files++;
  }
}
process.stdout.write(JSON.stringify({files, blocks, unresolved: [...unresolved]}, null, 2) + '\n');
if (unresolved.size) process.exitCode = 1;
