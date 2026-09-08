# SEC EDGAR

Namespace: `sec-edgar`

SEC EDGAR exposes public filing history and standardized XBRL data through `data.sec.gov`. No API key is required, but automated access must use an identifiable User-Agent and stay within SEC fair-access guidance.

## Submissions

```ruby
filings = app.call("integrations.sec-edgar.submissions", cik: "320193")
```
CIKs are normalized to SEC's 10-digit form automatically. If the response contains additional files in `filings.files`, fetch those files with:

```ruby
older = app.call("integrations.sec-edgar.submission_file", file: "CIK0000320193-submissions-001.json")
```
## XBRL Company Facts

```ruby
facts = app.call("integrations.sec-edgar.company_facts", cik: "320193")
accounts_payable = app.call("integrations.sec-edgar.company_concept", cik: "320193", taxonomy: "us-gaap", tag: "AccountsPayableCurrent")
```
`company_facts` returns the full standardized facts tree for a filer. `company_concept` narrows to one taxonomy and tag.

## Frames

```ruby
frame = app.call("integrations.sec-edgar.frames", taxonomy: "us-gaap", tag: "AccountsPayableCurrent", unit: "USD", period: "CY2019Q1I")
```
Period examples:

- `CY2019` for annual duration data
- `CY2019Q1` for quarterly duration data
- `CY2019Q1I` for point-in-time instant data

## Ticker Mappings

```ruby
tickers = app.call("integrations.sec-edgar.company_tickers")
exchanges = app.call("integrations.sec-edgar.ticker_exchanges")
```
These return SEC-published CIK/ticker/company-title mappings.

## Bulk Archives

```ruby
archives = app.call("integrations.sec-edgar.bulk_archives")
```
This returns the official SEC ZIP archive URLs. The tool does not download the ZIP files because they are large and should be fetched deliberately by a host workflow.
