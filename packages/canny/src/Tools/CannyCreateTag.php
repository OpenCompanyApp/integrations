<?php
namespace OpenCompany\Integrations\Canny\Tools;
/** Create a Canny tag. */
class CannyCreateTag extends AbstractCannyTool { protected const NAME = 'canny_create_tag'; protected const DESCRIPTION = 'Create a Canny tag.'; protected const OPERATION = 'create_tag'; protected const REQUIRED = ['name']; }
