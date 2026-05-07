# Companies House

Namespace: `companies_house`

The Companies House integration uses the official UK Public Data API. It requires a Companies House API key and sends it as the Basic auth username with an empty password.

Use company search first when you do not know the exact company number. For due diligence workflows, fetch the company profile, filing history, officers, charges, PSC list/statements, insolvency, and exemptions separately instead of assuming a search result contains the full record.

## Common Tools

- `companies_house_search_companies` searches by company name or company number.
- `companies_house_advanced_search_companies` supports official filters such as status, type, SIC code, incorporation dates, and location.
- `companies_house_company_profile` retrieves the current company profile by `company_number`.
- `companies_house_filing_history` lists filings; use `companies_house_filing_history_item` for a specific `transaction_id`.
- `companies_house_officers` lists company officers; use `companies_house_officer_appointments` when following an officer across companies.
- `companies_house_charges` and `companies_house_charge` cover mortgage and charge records.
- `companies_house_psc_list`, `companies_house_psc_statements`, and the PSC detail tools cover persons with significant control.
- `companies_house_disqualified_officer_natural` and `companies_house_disqualified_officer_corporate` fetch disqualified officer detail records.

## Notes For Agents

Company numbers are strings. Preserve leading zeroes. PSC and officer detail IDs usually come from links in list responses; do not invent them from names.

List endpoints accept pagination fields such as `items_per_page` and `start_index`. When comparing companies, keep payloads small by fetching only the sections you need.

Examples use fake values:

```lua
local matches = companies_house.search_companies({
  q = "example holdings",
  items_per_page = 5
})

local profile = companies_house.company_profile({
  company_number = "00000006"
})

local filings = companies_house.filing_history({
  company_number = "00000006",
  category = "accounts",
  items_per_page = 10
})

local pscs = companies_house.psc_list({
  company_number = "00000006",
  items_per_page = 10
})
```

The integration returns the normalized JSON shape provided by Companies House. It removes empty query values and comma-joins array query filters such as `category` and `sic_codes`.
