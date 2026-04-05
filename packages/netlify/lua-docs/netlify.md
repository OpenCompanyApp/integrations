# Netlify — Lua API Reference

## list_sites

List all Netlify sites the authenticated user has access to.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (1-based, default: 1) |
| `per_page` | integer | no | Number of sites per page (max 100, default: 20) |

### Examples

```lua
local result = app.integrations.netlify.list_sites({
  page = 1,
  per_page = 10
})

for _, site in ipairs(result) do
  print(site.name .. " — " .. site.url .. " (id: " .. site.id .. ")")
end
```

---

## get_site

Get detailed information about a specific Netlify site.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `site_id` | string | yes | The Netlify site ID |

### Examples

```lua
local result = app.integrations.netlify.get_site({
  site_id = "abc123-def456"
})

print("Site: " .. result.name)
print("URL: " .. result.url)
print("SSL: " .. tostring(result.ssl_enabled))
```

---

## create_site

Create a new Netlify site.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Name for the site (used as default subdomain) |
| `custom_domain` | string | no | Custom domain to assign |
| `repo` | object | no | Repository configuration for CI/CD |
| `body` | object | no | Additional site configuration |

### Examples

```lua
-- Create a simple site
local result = app.integrations.netlify.create_site({
  name = "my-awesome-site"
})
print("Created: " .. result.url)

-- Create with custom domain
local result = app.integrations.netlify.create_site({
  name = "my-site",
  custom_domain = "www.example.com"
})

-- Create with Git repo
local result = app.integrations.netlify.create_site({
  name = "my-site",
  repo = {
    provider = "github",
    repo = "myorg/myrepo",
    branch = "main",
    cmd = "npm run build",
    dir = "dist"
  }
})
```

---

## delete_site

Delete a Netlify site permanently. This cannot be undone.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `site_id` | string | yes | The Netlify site ID to delete |

### Examples

```lua
local result = app.integrations.netlify.delete_site({
  site_id = "abc123-def456"
})
print(result)
```

---

## list_deploys

List deploys for a Netlify site.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `site_id` | string | yes | The Netlify site ID |
| `page` | integer | no | Page number (1-based, default: 1) |
| `per_page` | integer | no | Results per page (max 100, default: 20) |

### Examples

```lua
local result = app.integrations.netlify.list_deploys({
  site_id = "abc123-def456",
  per_page = 5
})

for _, deploy in ipairs(result) do
  print(deploy.branch .. " @ " .. deploy.commit_ref .. " — " .. deploy.state)
end
```

---

## create_deploy

Trigger a new deploy for a Netlify site.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `site_id` | string | yes | The Netlify site ID |
| `title` | string | no | Title for the deploy |
| `branch` | string | no | Branch to deploy (default: production branch) |
| `framework` | string | no | Framework override (e.g., "nextjs", "nuxt", "hugo") |
| `body` | object | no | Additional deploy configuration |

### Examples

```lua
-- Trigger a production deploy
local result = app.integrations.netlify.create_deploy({
  site_id = "abc123-def456",
  title = "Deploy from AI agent"
})
print("Deploy created: " .. result.id)

-- Deploy a specific branch
local result = app.integrations.netlify.create_deploy({
  site_id = "abc123-def456",
  branch = "staging",
  title = "Staging deploy"
})
```

---

## list_forms

List all forms for a Netlify site.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `site_id` | string | yes | The Netlify site ID |

### Examples

```lua
local result = app.integrations.netlify.list_forms({
  site_id = "abc123-def456"
})

for _, form in ipairs(result) do
  print(form.name .. " — " .. form.submission_count .. " submissions")
end
```

---

## get_form

Get details for a specific Netlify form.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `form_id` | string | yes | The Netlify form ID |

### Examples

```lua
local result = app.integrations.netlify.get_form({
  form_id = "5e1a5c20-81c9-4c41-b0f0-251a6d7a7d6f"
})

print("Form: " .. result.name)
print("Path: " .. result.path)
print("Submissions: " .. result.submission_count)
```

---

## get_current_user

Get the currently authenticated Netlify user profile.

### Parameters

None.

### Examples

```lua
local result = app.integrations.netlify.get_current_user({})

print("User: " .. result.full_name .. " (" .. result.email .. ")")
print("Accounts: " .. #result.accounts)
```

---

## Multi-Account Usage

If you have multiple Netlify accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.netlify.list_sites({})

-- Explicit default (portable across setups)
app.integrations.netlify.default.list_sites({})

-- Named accounts
app.integrations.netlify.production.list_sites({})
app.integrations.netlify.staging.list_sites({})
```

All functions are identical across accounts — only the credentials differ.
