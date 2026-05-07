<?php
namespace OpenCompany\Integrations\Canny\Tools;
/** List Canny changelog entries. */
class CannyListEntries extends AbstractCannyTool { protected const NAME = 'canny_list_entries'; protected const DESCRIPTION = 'List Canny changelog entries with optional label, type, sort, limit, and skip filters.'; protected const OPERATION = 'list_entries'; }
