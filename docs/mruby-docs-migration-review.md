# mruby Script Documentation Migration Review

## Publication evidence

- The public catalog was regenerated from the checked-out package source on 2026-09-08. It contains 591 public integrations and 41,493 tools.
- `scripts/check-mruby-contracts.php` exported 608 source packages and 41,995 tools, then verified 224,442 published function and parameter paths (74,814 account-qualified paths).
- The focused Script bridge, Script runtime, and catalog suite passed: 11 tests and 60 assertions.
- The Ruby documentation compiler validates syntax only. It does not invoke providers, resolve credentials, or make network/API calls; no live-provider verification was performed for this migration.

## Reviewed authored references

The converter must preserve these manually checked pages listed in
`scripts/reviewed-ruby-docs.json`:

- LangSmith, PostHog, Ramp, SmartRecruiters, X, and X Ads.
- Microsoft Entra ID, Excel, Intune, Places, and SharePoint.

The reviewed examples use the exact Script bridge form
`app.call("integrations.<provider>.<tool-slug>", keywords)` and are tied to
published tool slugs rather than display-name guesses. Converter-generated
pages may use the supported receiver form
`app.integrations.<provider>.<published-function-name>(...)` where every path
segment is a Ruby identifier; the Script catalog maps those published function
names to their exact source slugs. `app.call` remains required for a hyphenated
or otherwise non-identifier path segment.

## Contract boundary

Ruby syntax compilation is a static check only. It does not invoke providers,
resolve credentials, or prove that a configured workspace can dispatch a tool.
The catalog and Script runtime tests cover local path publication and bridge
resolution, while provider behavior remains unverified without live
credentials.

Literal references to Lua remaining in provider documentation are limited to
provider data, such as GitHub repository-search terms or file names and an
external Lua URL; they are not host scripting contracts.
