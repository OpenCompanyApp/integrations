# openFDA

Namespace: `openfda`

openFDA exposes public FDA datasets for drugs, medical devices, food, animal and veterinary products, cosmetics, tobacco, substances, identifiers, and historical documents. Most endpoints share the same query parameters:

- `search`: fielded search expression
- `count`: aggregate counts by field
- `sort`: sort expression
- `limit`: maximum results or count buckets
- `skip`: pagination offset
- `api_key`: optional openFDA API key for higher daily limits

## Examples

```js
var labels = openfda.drug_label({
  search: 'openfda.generic_name:"acetaminophen"',
  limit: 5,
})

var reactions = openfda.drug_event({
  search: 'patient.drug.openfda.generic_name:"metformin"',
  count: "patient.reaction.reactionmeddrapt.exact",
  limit: 10,
})

var recalls = openfda.food_enforcement({
  sort: "report_date:desc",
  limit: 10,
})
```
## Dataset Tools

Drug datasets:

- `openfda_drug_event`
- `openfda_drug_label`
- `openfda_drug_enforcement`
- `openfda_drug_ndc`
- `openfda_drug_drugsfda`
- `openfda_drug_shortages`

Device datasets:

- `openfda_device_510k`
- `openfda_device_classification`
- `openfda_device_enforcement`
- `openfda_device_event`
- `openfda_device_pma`
- `openfda_device_recall`
- `openfda_device_registrationlisting`
- `openfda_device_udi`
- `openfda_device_covid19_serology`

Other FDA datasets:

- `openfda_food_enforcement`
- `openfda_food_event`
- `openfda_animal_veterinary_event`
- `openfda_cosmetic_event`
- `openfda_tobacco_problem`
- `openfda_other_nsde`
- `openfda_other_substance`
- `openfda_other_unii`
- `openfda_other_historicaldocument`

The response is the original JSON shape from openFDA, usually including `meta` and either `results` records or count buckets.
