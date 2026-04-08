# Lemlist — Lua API Reference

## list_campaigns

List all outreach campaigns in Lemlist.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `status` | string | no | Filter by status: `"active"`, `"draft"`, `"paused"`, `"completed"` |
| `limit` | integer | no | Maximum number of campaigns to return |
| `offset` | integer | no | Number of campaigns to skip for pagination |

### Examples

```lua
-- List all campaigns
local result = app.integrations.lemlist.list_campaigns({})

for _, campaign in ipairs(result) do
  print(campaign.name .. " (" .. campaign._id .. ") - " .. campaign.status)
end

-- Filter active campaigns
local result = app.integrations.lemlist.list_campaigns({
  status = "active"
})
```

---

## get_campaign

Get details of a specific campaign by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `campaign_id` | string | yes | The ID of the campaign to retrieve |

### Examples

```lua
local result = app.integrations.lemlist.get_campaign({
  campaign_id = "cam_abc123"
})

print("Campaign: " .. result.name)
print("Status: " .. result.status)
print("Leads count: " .. result.leadsCount)
```

---

## list_leads

List leads in a specific campaign.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `campaign_id` | string | yes | The ID of the campaign |
| `status` | string | no | Filter by lead status: `"interested"`, `"notInterested"`, `"bounced"`, `"sent"`, `"replied"`, `"autoreplied"`, `"clicked"`, `"opened"` |
| `limit` | integer | no | Maximum number of leads to return |
| `offset` | integer | no | Number of leads to skip for pagination |

### Examples

```lua
-- List all leads in a campaign
local result = app.integrations.lemlist.list_leads({
  campaign_id = "cam_abc123"
})

for _, lead in ipairs(result) do
  print(lead.email .. " - " .. lead.status)
end

-- Filter leads who replied
local result = app.integrations.lemlist.list_leads({
  campaign_id = "cam_abc123",
  status = "replied"
})
```

---

## add_lead

Add a lead to a campaign. The lead will be queued for outreach according to the campaign schedule.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `campaign_id` | string | yes | The ID of the campaign to add the lead to |
| `email` | string | yes | The lead's email address |
| `firstName` | string | no | The lead's first name |
| `lastName` | string | no | The lead's last name |
| `companyName` | string | no | The lead's company name |
| `phone` | string | no | The lead's phone number |
| `linkedinUrl` | string | no | The lead's LinkedIn profile URL |
| `variables` | object | no | Custom variables for campaign templates (key-value pairs) |

### Examples

```lua
-- Add a simple lead
local result = app.integrations.lemlist.add_lead({
  campaign_id = "cam_abc123",
  email = "john@example.com"
})

-- Add a lead with full details
local result = app.integrations.lemlist.add_lead({
  campaign_id = "cam_abc123",
  email = "jane@acme.com",
  firstName = "Jane",
  lastName = "Smith",
  companyName = "Acme Inc",
  phone = "+1234567890"
})

-- Add a lead with custom variables for personalization
local result = app.integrations.lemlist.add_lead({
  campaign_id = "cam_abc123",
  email = "bob@startup.io",
  firstName = "Bob",
  variables = {
    industry = "SaaS",
    meeting_link = "https://cal.com/bob/30min"
  }
})
```

---

## list_teams

List all teams in the Lemlist account.

### Parameters

None.

### Examples

```lua
local result = app.integrations.lemlist.list_teams({})

for _, team in ipairs(result) do
  print(team.name .. " - " .. #team.members .. " members")
end
```

---

## list_subaccounts

List all sub-accounts in the Lemlist account.

### Parameters

None.

### Examples

```lua
local result = app.integrations.lemlist.list_subaccounts({})

for _, sub in ipairs(result) do
  print(sub.name .. " - " .. sub.status)
end
```

---

## get_current_user

Get the profile of the currently authenticated Lemlist user.

### Parameters

None.

### Examples

```lua
local result = app.integrations.lemlist.get_current_user({})

print("Logged in as: " .. result.email)
print("Plan: " .. result.plan)
print("Team: " .. result.teamName)
```

---

## Multi-Account Usage

If you have multiple Lemlist accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.lemlist.function_name({...})

-- Explicit default (portable across setups)
app.integrations.lemlist.default.function_name({...})

-- Named accounts
app.integrations.lemlist.agency.function_name({...})
app.integrations.lemlist.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
