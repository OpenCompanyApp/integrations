<?php
namespace OpenCompany\Integrations\Readwise\Tools;
/** List Reader documents. */
class ReadwiseListDocuments extends AbstractReadwiseTool { protected const NAME = 'readwise_list_documents'; protected const DESCRIPTION = 'List Reader documents with updatedAfter, location, category, tag, limit, and pageCursor filters.'; protected const OPERATION = 'list_documents'; }
