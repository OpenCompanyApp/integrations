<?php
namespace OpenCompany\Integrations\Canny\Tools;
/** Retrieve a Canny tag. */
class CannyRetrieveTag extends AbstractCannyTool { protected const NAME = 'canny_retrieve_tag'; protected const DESCRIPTION = 'Retrieve a Canny tag by ID.'; protected const OPERATION = 'retrieve_tag'; protected const REQUIRED = ['id']; }
