<?php
namespace OpenCompany\Integrations\Readwise\Tools;
/** Get one Readwise book. */
class ReadwiseGetBook extends AbstractReadwiseTool { protected const NAME = 'readwise_get_book'; protected const DESCRIPTION = 'Get one Readwise book by book_id.'; protected const OPERATION = 'get_book'; protected const REQUIRED = ['book_id']; }
