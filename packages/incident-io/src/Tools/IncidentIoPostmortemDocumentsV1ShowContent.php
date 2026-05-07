<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * ShowContent PostmortemDocuments V1.
 *
 * Maps to the official incident.io endpoint get /v1/postmortem_documents/{id}/content.
 */
class IncidentIoPostmortemDocumentsV1ShowContent extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_postmortem_documents_v1_show_content';
    protected const DESCRIPTION = 'ShowContent PostmortemDocuments V1

Official incident.io endpoint: GET /v1/postmortem_documents/{id}/content

Fetch the content of a post-mortem document, rendered as markdown.

The response contains the full document content as a single markdown string. The markdown
follows standard formatting and is structured to mirror the post-mortem as it appears in
the incident.io dashboard:

- **Headings** (`#`, `##`, `###`) for document title and sections
- **Bold** and *italic* text formatting
- Bullet lists and numbered lists
- [Links](url) to external resources, Slack threads, and pull requests
- Mentions of users, incidents, and catalog entries resolved to their display names
- Custom field values rendered as labelled bullet lists
- Timeline entries grouped by date with timestamps
- Follow-ups with assignees and descriptions

To preview what this markdown will look like for a given post-mortem, open the document
in the incident.io dashboard and use the "Copy to clipboard" button. The copied content
uses the same rendering pipeline as this endpoint.

If you only need document metadata, use the Show or List endpoints instead.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Unique identifier for the post-mortem document',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/postmortem_documents/{id}/content';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
