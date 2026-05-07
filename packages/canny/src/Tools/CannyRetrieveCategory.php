<?php
namespace OpenCompany\Integrations\Canny\Tools;
/** Retrieve a Canny category by ID. */
class CannyRetrieveCategory extends AbstractCannyTool { protected const NAME = 'canny_retrieve_category'; protected const DESCRIPTION = 'Retrieve a Canny category by ID.'; protected const OPERATION = 'retrieve_category'; protected const REQUIRED = ['id']; }
