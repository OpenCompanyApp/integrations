# Integration: MongoDB Atlas Data API

MongoDB Atlas Data API v1 integration for OpenCompany and KosmoKrator agents. This package covers the official deprecated Data API action surface for document reads, writes, deletes, and aggregation.

## Authentication

Configure:

- `api_key`: MongoDB Atlas Data API key.
- `cluster_url`: full Data API endpoint URL ending in `/endpoint/data/v1`.
- `data_source`: linked data source name. Defaults to `mongodb-atlas`.

## Tools

| Tool | Type | Operation |
| --- | --- | --- |
| `mongodb_find` | read | `POST /action/find` |
| `mongodb_find_one` | read | `POST /action/findOne` |
| `mongodb_insert_one` | write | `POST /action/insertOne` |
| `mongodb_insert_many` | write | `POST /action/insertMany` |
| `mongodb_update_one` | write | `POST /action/updateOne` |
| `mongodb_update_many` | write | `POST /action/updateMany` |
| `mongodb_delete_one` | write | `POST /action/deleteOne` |
| `mongodb_delete_many` | write | `POST /action/deleteMany` |
| `mongodb_aggregate` | read | `POST /action/aggregate` |

The package does not expose Atlas Administration API endpoints. Those use different authentication and belong in a separate integration.

## Source

- API reference: https://www.mongodb.com/docs/api/doc/atlas-data-api-v1/
