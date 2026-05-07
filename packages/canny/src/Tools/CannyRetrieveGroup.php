<?php
namespace OpenCompany\Integrations\Canny\Tools;
/** Retrieve a Canny group. */
class CannyRetrieveGroup extends AbstractCannyTool { protected const NAME = 'canny_retrieve_group'; protected const DESCRIPTION = 'Retrieve a Canny group by ID.'; protected const OPERATION = 'retrieve_group'; protected const REQUIRED = ['id']; }
