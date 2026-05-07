<?php
namespace OpenCompany\Integrations\Readwise\Tools;
/** Bulk update Reader documents. */
class ReadwiseBulkUpdateDocuments extends AbstractReadwiseTool { protected const NAME = 'readwise_bulk_update_documents'; protected const DESCRIPTION = 'Bulk update Reader documents using an updates array.'; protected const OPERATION = 'bulk_update_documents'; protected const REQUIRED = ['updates']; }
