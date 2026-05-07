<?php
namespace OpenCompany\Integrations\Readwise\Tools;
/** Export Readwise highlight data. */
class ReadwiseExportHighlights extends AbstractReadwiseTool { protected const NAME = 'readwise_export_highlights'; protected const DESCRIPTION = 'Export Readwise highlights for incremental sync using updatedAfter and pageCursor.'; protected const OPERATION = 'export_highlights'; }
