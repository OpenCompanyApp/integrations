# Clearbit — Lua API Reference

## enrich_person

Look up a person by email address. Returns social profiles, employment, location, and demographic data when available.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email` | string | yes | The email address of the person to look up (e.g., `"alex@stripe.com"`) |

### Examples

```lua
local result = app.integrations.clearbit.enrich_person({
  email = "alex@stripe.com"
})

if result.found ~= false then
  print(result.person.fullName)
  print(result.person.employment.title)
  print(result.person.employment.name)
end
```

---

## enrich_company

Look up a company by domain name. Returns company metrics, industry categorization, social profiles, and funding data.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `domain` | string | yes | The company domain (e.g., `"stripe.com"`) |

### Examples

```lua
local result = app.integrations.clearbit.enrich_company({
  domain = "stripe.com"
})

if result.found ~= false then
  print(result.name)
  print(result.category.industry)
  print(result.metrics.employees)
end
```

---

## reveal

Identify the company and person behind an IP address. Useful for de-anonymizing website visitors.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `ip` | string | yes | IPv4 or IPv6 address (e.g., `"104.193.168.24"`) |

### Examples

```lua
local result = app.integrations.clearbit.reveal({
  ip = "104.193.168.24"
})

if result.found ~= false then
  print(result.company.name)
  print(result.person.fullName)
end
```

---

## prospect

Find people by job title and/or company name. Returns lists of matching people with names, titles, and email addresses.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `title` | string | no | Job title to search for (e.g., `"CEO"`, `"Software Engineer"`) |
| `company` | string | no | Company name to filter by (e.g., `"Stripe"`) |
| `page` | integer | no | Page number for pagination (default: 1) |

At least one of `title` or `company` must be provided.

### Examples

```lua
-- Find all CEOs at Stripe
local result = app.integrations.clearbit.prospect({
  title = "CEO",
  company = "Stripe"
})

for _, person in ipairs(result.results or {}) do
  print(person.fullName .. " — " .. person.title)
end
```

```lua
-- Find all Software Engineers (any company)
local result = app.integrations.clearbit.prospect({
  title = "Software Engineer",
  page = 1
})
```

---

## list_autocomplete

Search for companies by name. Returns a list of matching companies with domains, logos, and descriptions. Ideal for type-ahead / autocomplete UI flows.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Company name or prefix to search for (e.g., `"Stripe"`, `"Goo"`) |

### Examples

```lua
local result = app.integrations.clearbit.list_autocomplete({
  name = "Stripe"
})

for _, company in ipairs(result) do
  print(company.name .. " — " .. company.domain)
end
```

---

## get_current_user

Get the authenticated user's Clearbit account information. Useful for verifying API credentials and checking plan details.

### Parameters

None.

### Examples

```lua
local result = app.integrations.clearbit.get_current_user({})

print("Account: " .. result.name)
print("Plan: " .. (result.plan or "unknown"))
```

---

## Multi-Account Usage

If you have multiple Clearbit accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.clearbit.enrich_person({ email = "alex@stripe.com" })

-- Explicit default (portable across setups)
app.integrations.clearbit.default.enrich_person({ email = "alex@stripe.com" })

-- Named accounts
app.integrations.clearbit.sales.enrich_person({ email = "alex@stripe.com" })
app.integrations.clearbit.marketing.enrich_company({ domain = "stripe.com" })
```

All functions are identical across accounts — only the credentials differ.
