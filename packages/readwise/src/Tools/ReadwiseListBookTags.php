<?php
namespace OpenCompany\Integrations\Readwise\Tools;
/** List tags for a Readwise book. */
class ReadwiseListBookTags extends AbstractReadwiseTool { protected const NAME = 'readwise_list_book_tags'; protected const DESCRIPTION = 'List tags for a Readwise book.'; protected const OPERATION = 'list_book_tags'; protected const REQUIRED = ['book_id']; }
