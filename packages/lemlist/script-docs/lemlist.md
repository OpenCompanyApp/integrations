# Lemlist — JavaScript API Reference

## list_campaigns

List all outreach campaigns in Lemlist.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `status` | string | no | Filter by status: `"active"`, `"draft"`, `"paused"`, `"completed"` |
| `limit` | integer | no | Maximum number of campaigns to return |
| `offset` | integer | no | Number of campaigns to skip for pagination |

### Examples

```js
// List all campaigns
var result = app.integrations.lemlist.list_campaigns({})

for (const campaign of (result)) {
  console.log(campaign.name + " (" + campaign._id + ") - " + campaign.status)
}

// Filter active campaigns
var result = app.integrations.lemlist.list_campaigns({
  status: "active",
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

```js
var result = app.integrations.lemlist.get_campaign({
  campaign_id: "cam_abc123",
})

console.log("Campaign: " + result.name)
console.log("Status: " + result.status)
console.log("Leads count: " + result.leadsCount)
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

```js
// List all leads in a campaign
var result = app.integrations.lemlist.list_leads({
  campaign_id: "cam_abc123",
})

for (const lead of (result)) {
  console.log(lead.email + " - " + lead.status)
}

// Filter leads who replied
var result = app.integrations.lemlist.list_leads({
  campaign_id: "cam_abc123",
  status: "replied",
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

```js
// Add a simple lead
var result = app.integrations.lemlist.add_lead({
  campaign_id: "cam_abc123",
  email: "john@example.com",
})

// Add a lead with full details
var result = app.integrations.lemlist.add_lead({
  campaign_id: "cam_abc123",
  email: "jane@acme.com",
  firstName: "Jane",
  lastName: "Smith",
  companyName: "Acme Inc",
  phone: "+1234567890",
})

// Add a lead with custom variables for personalization
var result = app.integrations.lemlist.add_lead({
  campaign_id: "cam_abc123",
  email: "bob@startup.io",
  firstName: "Bob",
  variables: {
    industry: "SaaS",
    meeting_link: "https://cal.com/bob/30min",
  }
})
```
---

## list_teams

List all teams in the Lemlist account.

### Parameters

None.

### Examples

```js
var result = app.integrations.lemlist.list_teams({})

for (const team of (result)) {
  console.log(team.name + " - " + team.members.length + " members")
}
```
---

## list_subaccounts

List all sub-accounts in the Lemlist account.

### Parameters

None.

### Examples

```js
var result = app.integrations.lemlist.list_subaccounts({})

for (const sub of (result)) {
  console.log(sub.name + " - " + sub.status)
}
```
---

## get_current_user

Get the profile of the currently authenticated Lemlist user.

### Parameters

None.

### Examples

```js
var result = app.integrations.lemlist.get_current_user({})

console.log("Logged in as: " + result.email)
console.log("Plan: " + result.plan)
console.log("Team: " + result.teamName)
```
---

## Multi-Account Usage

If you have multiple Lemlist accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.lemlist.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.lemlist.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.lemlist.agency.function_name({ /* parameters */ })
app.integrations.lemlist.personal.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
