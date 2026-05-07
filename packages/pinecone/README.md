# Integration: Pinecone

Pinecone vector database integration for OpenCompany and KosmoKrator agents. The package covers common control-plane index operations and data-plane vector operations from the official Pinecone REST API.

## Authentication

Configure:

- `api_key`: Pinecone API key. This is sent as the `Api-Key` header.
- `url`: control-plane API base URL. Defaults to `https://api.pinecone.io`.
- `api_version`: date-based API version header. Defaults to `2026-04`.

## Tools

| Tool | Type | Operation |
| --- | --- | --- |
| `pinecone_list_indexes` | read | `GET /indexes` |
| `pinecone_get_index` | read | `GET /indexes/{name}` |
| `pinecone_create_index` | write | `POST /indexes` |
| `pinecone_configure_index` | write | `PATCH /indexes/{name}` |
| `pinecone_delete_index` | write | `DELETE /indexes/{name}` |
| `pinecone_upsert_vectors` | write | `POST /vectors/upsert` on index host |
| `pinecone_query_vectors` | read | `POST /query` on index host |
| `pinecone_fetch_vectors` | read | `GET /vectors/fetch` on index host |
| `pinecone_update_vector` | write | `POST /vectors/update` on index host |
| `pinecone_delete_vectors` | write | `POST /vectors/delete` on index host |
| `pinecone_describe_index_stats` | read | `POST /describe_index_stats` on index host |
| `pinecone_list_collections` | read | `GET /collections` |

Data-plane tools require an `index_host`, which is available from `pinecone_get_index`.

## Source

- API reference: https://docs.pinecone.io/reference/api
