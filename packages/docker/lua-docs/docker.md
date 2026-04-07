# Docker Hub — Lua API Reference

## list_repositories

List Docker Hub repositories. Optionally filter by namespace.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `namespace` | string | no | Docker Hub namespace (username or organization) to filter by |
| `page_size` | integer | no | Number of repositories per page (default: 25) |
| `page` | integer | no | Page number for pagination (1-indexed, default: 1) |

### Examples

```lua
-- List repositories
local result = app.integrations.docker.list_repositories({
  page_size = 10,
  page = 1
})

for _, repo in ipairs(result.results) do
  print(repo.namespace .. "/" .. repo.name .. " - " .. repo.description)
end

-- List repositories for a specific namespace
local result = app.integrations.docker.list_repositories({
  namespace = "myorg",
  page_size = 50
})

for _, repo in ipairs(result.results) do
  print(repo.name .. " (pulls: " .. repo.pull_count .. ")")
end
```

---

## get_repository

Get details for a specific Docker Hub repository.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `namespace` | string | yes | The Docker Hub namespace (username or organization) |
| `name` | string | yes | The repository name |

### Examples

```lua
local result = app.integrations.docker.get_repository({
  namespace = "library",
  name = "nginx"
})

print(result.name)
print(result.description)
print("Stars: " .. result.star_count)
print("Pulls: " .. result.pull_count)
print("Private: " .. tostring(result.is_private))
```

---

## list_tags

List tags for a Docker Hub repository.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `namespace` | string | yes | The Docker Hub namespace (username or organization) |
| `name` | string | yes | The repository name |
| `page_size` | integer | no | Number of tags per page (default: 25) |
| `page` | integer | no | Page number for pagination (1-indexed, default: 1) |

### Examples

```lua
local result = app.integrations.docker.list_tags({
  namespace = "library",
  name = "nginx",
  page_size = 10
})

for _, tag in ipairs(result.results) do
  print(tag.name .. " (" .. tag.full_size .. " bytes)")
end
```

---

## get_tag

Get details for a specific tag in a Docker Hub repository.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `namespace` | string | yes | The Docker Hub namespace (username or organization) |
| `name` | string | yes | The repository name |
| `tag` | string | yes | The tag name (e.g., "latest", "1.0.0") |

### Examples

```lua
local result = app.integrations.docker.get_tag({
  namespace = "library",
  name = "nginx",
  tag = "latest"
})

print("Tag: " .. result.name)
print("Full size: " .. result.full_size .. " bytes")
print("Digest: " .. result.images[1].digest)
```

---

## create_repository

Create a new Docker Hub repository.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `namespace` | string | yes | Docker Hub namespace (username or organization) |
| `name` | string | yes | Repository name (must be unique within the namespace) |
| `description` | string | no | Short description of the repository |
| `full_description` | string | no | Full description (supports Markdown) |
| `is_private` | boolean | no | Whether the repository is private (default: false) |

### Examples

```lua
-- Create a public repository
local result = app.integrations.docker.create_repository({
  namespace = "myorg",
  name = "my-app",
  description = "My application container image",
  full_description = "# My App\n\nA containerized version of my application.",
  is_private = false
})

print("Created: " .. result.namespace .. "/" .. result.name)

-- Create a private repository
local result = app.integrations.docker.create_repository({
  namespace = "myorg",
  name = "internal-service",
  is_private = true
})
```

---

## list_organizations

List Docker Hub organizations the authenticated user belongs to.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_size` | integer | no | Number of organizations per page (default: 25) |
| `page` | integer | no | Page number for pagination (1-indexed, default: 1) |

### Examples

```lua
local result = app.integrations.docker.list_organizations({
  page_size = 50
})

for _, org in ipairs(result.results) do
  print(org.orgname .. " (" .. org.full_name .. ")")
end
```

---

## get_current_user

Get the profile of the currently authenticated Docker Hub user.

### Parameters

None.

### Examples

```lua
local result = app.integrations.docker.get_current_user({})
print("Logged in as: " .. result.username .. " (" .. result.full_name .. ")")
print("ID: " .. result.id)
```

---

## Multi-Account Usage

If you have multiple Docker Hub accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.docker.function_name({...})

-- Explicit default (portable across setups)
app.integrations.docker.default.function_name({...})

-- Named accounts
app.integrations.docker.production.function_name({...})
app.integrations.docker.staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
