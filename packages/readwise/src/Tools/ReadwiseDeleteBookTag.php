<?php
namespace OpenCompany\Integrations\Readwise\Tools;
/** Delete a tag from a Readwise book. */
class ReadwiseDeleteBookTag extends AbstractReadwiseTool { protected const NAME = 'readwise_delete_book_tag'; protected const DESCRIPTION = 'Delete a tag from a Readwise book.'; protected const OPERATION = 'delete_book_tag'; protected const REQUIRED = ['book_id', 'tag_id']; }
