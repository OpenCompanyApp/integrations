<?php
namespace OpenCompany\Integrations\Readwise\Tools;
/** Create a tag on a Readwise book. */
class ReadwiseCreateBookTag extends AbstractReadwiseTool { protected const NAME = 'readwise_create_book_tag'; protected const DESCRIPTION = 'Create a tag on a Readwise book.'; protected const OPERATION = 'create_book_tag'; protected const REQUIRED = ['book_id', 'name']; }
