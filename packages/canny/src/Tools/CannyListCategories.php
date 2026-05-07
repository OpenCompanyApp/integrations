<?php
namespace OpenCompany\Integrations\Canny\Tools;
/** List Canny categories. */
class CannyListCategories extends AbstractCannyTool { protected const NAME = 'canny_list_categories'; protected const DESCRIPTION = 'List Canny categories with optional boardID, limit, and skip filters.'; protected const OPERATION = 'list_categories'; }
