<?php
namespace OpenCompany\Integrations\Canny\Tools;
/** Create a Canny changelog entry. */
class CannyCreateEntry extends AbstractCannyTool { protected const NAME = 'canny_create_entry'; protected const DESCRIPTION = 'Create and optionally publish a Canny changelog entry.'; protected const OPERATION = 'create_entry'; protected const REQUIRED = ['title', 'details']; }
