<?php
namespace OpenCompany\Integrations\Readwise\Tools;
/** Save a document to Reader. */
class ReadwiseSaveDocument extends AbstractReadwiseTool { protected const NAME = 'readwise_save_document'; protected const DESCRIPTION = 'Save a URL or HTML document to Reader.'; protected const OPERATION = 'save_document'; protected const REQUIRED = ['url']; }
