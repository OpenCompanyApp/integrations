# OpenSSF Scorecard

Namespace: `openssf-scorecard`

Use this integration to retrieve published OpenSSF Scorecard results for open
source repositories, inspect individual security checks, fetch badge SVGs, and
build viewer URLs.

## Authentication

The published OpenSSF Scorecard API is public and requires no credentials.

## Tools

- `openssf_scorecard_result`: retrieves the published JSON result for a
  repository. Pass `uri = "github.com/org/repo"` or `platform`, `org`, and
  `repo`. The optional `commit` parameter selects a specific 40-character SHA.
- `openssf_scorecard_check`: retrieves one check from the result, such as
  `Maintained`, `Security-Policy`, `Code-Review`, or `Vulnerabilities`.
- `openssf_scorecard_badge`: retrieves the badge SVG. Optional `style` values
  are `plastic`, `flat`, `flat-square`, `for-the-badge`, and `social`.
- `openssf_scorecard_viewer_url`: builds a public viewer URL for the repository.

## Return Notes

`openssf_scorecard_result` keeps the API response field names intact. Results
include `date`, `repo`, `scorecard`, aggregate `score`, and `checks`.

Each check includes fields such as `name`, `score`, `reason`, `details`, and
`documentation`. Not every repository has a published result; the API only
serves projects that have published Scorecard output.

## Examples

```lua
local result = tools.openssf_scorecard_result({
  uri = "github.com/ossf/scorecard"
})

local security_policy = tools.openssf_scorecard_check({
  uri = "github.com/ossf/scorecard",
  check = "Security-Policy"
})

local badge = tools.openssf_scorecard_badge({
  uri = "github.com/ossf/scorecard",
  style = "flat"
})
```

Scores are useful supply-chain signals, not absolute safety guarantees. Inspect
individual check reasons and details before drawing conclusions.
