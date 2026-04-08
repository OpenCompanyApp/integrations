# Patreon — Lua API Reference

## list_campaigns

List all campaigns for the authenticated Patreon creator.

### Parameters

None.

### Examples

```lua
local result = app.integrations.patreon.list_campaigns()

for _, campaign in ipairs(result.campaigns) do
  print(campaign.attributes.creation_name .. " — Patrons: " .. campaign.attributes.patron_count)
end
```

---

## get_campaign

Get detailed information about a single Patreon campaign.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `campaign_id` | string | yes | The ID of the campaign to retrieve |

### Example

```lua
local result = app.integrations.patreon.get_campaign({
  campaign_id = "123456"
})

print(result.attributes.creation_name)
print(result.attributes.summary)
print(result.attributes.patron_count)
```

---

## list_members

List members (patrons) for a Patreon campaign.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `campaign_id` | string | yes | The ID of the campaign to list members for |

### Examples

#### All members

```lua
local result = app.integrations.patreon.list_members({
  campaign_id = "123456"
})

for _, member in ipairs(result.members) do
  print(member.attributes.full_name .. " — " .. member.attributes.patron_status)
end
```

---

## get_member

Get details for a single Patreon member.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `member_id` | string | yes | The ID of the member to retrieve |

### Example

```lua
local result = app.integrations.patreon.get_member({
  member_id = "789012"
})

print(result.attributes.full_name)
print(result.attributes.email)
print(result.attributes.patron_status)
```

---

## list_posts

List posts for a Patreon campaign.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `campaign_id` | string | yes | The ID of the campaign to list posts for |

### Examples

```lua
local result = app.integrations.patreon.list_posts({
  campaign_id = "123456"
})

for _, post in ipairs(result.posts) do
  print(post.attributes.title .. " — " .. post.attributes.published_at)
end
```

---

## get_post

Get details for a single Patreon post.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `post_id` | string | yes | The ID of the post to retrieve |

### Example

```lua
local result = app.integrations.patreon.get_post({
  post_id = "345678"
})

print(result.attributes.title)
print(result.attributes.content)
print(result.attributes.published_at)
```

---

## get_current_user

Get the profile of the currently authenticated Patreon user.

### Parameters

None.

### Example

```lua
local result = app.integrations.patreon.get_current_user()

print("Connected as: " .. result.attributes.full_name)
print("Email: " .. result.attributes.email)
```

---

## Multi-Account Usage

If you have multiple Patreon accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.patreon.function_name({...})

-- Explicit default (portable across setups)
app.integrations.patreon.default.function_name({...})

-- Named accounts
app.integrations.patreon.main_creator.function_name({...})
app.integrations.patreon.side_project.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
