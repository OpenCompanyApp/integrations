<?php
namespace OpenCompany\Integrations\Readwise\Tools;
/** Update a Reader document. */
class ReadwiseUpdateDocument extends AbstractReadwiseTool { protected const NAME = 'readwise_update_document'; protected const DESCRIPTION = 'Update metadata, tags, notes, location, category, or seen state for a Reader document.'; protected const OPERATION = 'update_document'; protected const REQUIRED = ['document_id']; }
