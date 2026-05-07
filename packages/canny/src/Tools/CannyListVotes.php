<?php
namespace OpenCompany\Integrations\Canny\Tools;
/** List Canny votes. */
class CannyListVotes extends AbstractCannyTool { protected const NAME = 'canny_list_votes'; protected const DESCRIPTION = 'List Canny votes with cursor pagination and post, board, company, or user filters.'; protected const OPERATION = 'list_votes'; }
