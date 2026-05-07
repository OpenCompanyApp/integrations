<?php
namespace OpenCompany\Integrations\Readwise\Tools;
/** Delete a Reader document. */
class ReadwiseDeleteDocument extends AbstractReadwiseTool { protected const NAME = 'readwise_delete_document'; protected const DESCRIPTION = 'Delete a Reader document.'; protected const OPERATION = 'delete_document'; protected const REQUIRED = ['document_id']; }
