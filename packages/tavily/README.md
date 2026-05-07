# Tavily Integration

> Tavily integration for the Laravel AI SDK — search, extract, crawl, map, research, and usage tools for AI agents. Part of the OpenCompany integration ecosystem.

This package exposes Tavily's public JSON API through small, focused tools. It uses API-key authentication, supports optional `X-Project-ID` scoping, and keeps response payloads in Tavily's native shape so agents can rely on the official fields.

## Tools

| Tool | Type | Description |
|------|------|-------------|
| `tavily_search` | read | Execute Tavily Search with answer, raw content, image, domain, date, topic, and usage controls |
| `tavily_extract` | read | Extract clean content from one or more URLs |
| `tavily_crawl` | read | Crawl a website and extract content from discovered pages |
| `tavily_map` | read | Map a website and return discovered URLs |
| `tavily_create_research_task` | read | Queue an asynchronous Tavily Research task |
| `tavily_get_research_task` | read | Retrieve status or completed content for a research task |
| `tavily_get_usage` | read | Retrieve key and account credit usage |

## Configuration

Required:

- `api_key`

Optional:

- `project_id` — sent as `X-Project-ID`
- `url` — defaults to `https://api.tavily.com`

## Notes

The Tavily Research streaming endpoint returns Server-Sent Events, so this package exposes the non-streaming create-and-poll workflow for JSON tool execution.
