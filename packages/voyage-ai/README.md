# Voyage AI Integration

> Voyage AI integration for the Laravel AI SDK — embeddings, reranking, multimodal embeddings, contextualized embeddings, files, and batch inference. Part of the OpenCompany integration ecosystem.

This package exposes Voyage AI's official JSON and multipart APIs through focused tools for retrieval and RAG workflows.

## Tools

| Tool | Type | Description |
|------|------|-------------|
| `voyage_ai_create_embedding` | read | Create text embeddings |
| `voyage_ai_create_contextualized_embeddings` | read | Create contextualized chunk embeddings |
| `voyage_ai_create_multimodal_embeddings` | read | Create multimodal embeddings |
| `voyage_ai_rerank` | read | Rerank documents for a query |
| `voyage_ai_upload_file` | write | Upload a JSONL batch file |
| `voyage_ai_list_files` | read | List files |
| `voyage_ai_retrieve_file` | read | Retrieve file metadata |
| `voyage_ai_retrieve_file_content` | read | Retrieve file content |
| `voyage_ai_delete_file` | write | Delete one file |
| `voyage_ai_bulk_delete_files` | write | Delete multiple files atomically |
| `voyage_ai_create_batch` | write | Create a batch inference job |
| `voyage_ai_list_batches` | read | List batch jobs |
| `voyage_ai_retrieve_batch` | read | Retrieve a batch job |
| `voyage_ai_cancel_batch` | write | Cancel a batch job |

## Configuration

Required:

- `api_key`

Optional:

- `url` — defaults to `https://api.voyageai.com/v1`

## Notes

Batch upload accepts raw JSONL content and sends it as multipart form data with `purpose=batch`. Batch output and error files can be downloaded with `voyage_ai_retrieve_file_content`.
