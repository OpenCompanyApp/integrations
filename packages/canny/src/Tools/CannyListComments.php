<?php
namespace OpenCompany\Integrations\Canny\Tools;
/** List Canny comments. */
class CannyListComments extends AbstractCannyTool { protected const NAME = 'canny_list_comments'; protected const DESCRIPTION = 'List Canny comments with cursor pagination and post, board, company, or author filters.'; protected const OPERATION = 'list_comments'; }
