<?php
namespace OpenCompany\Integrations\Canny\Tools;
/** Retrieve a Canny idea. */
class CannyRetrieveIdea extends AbstractCannyTool { protected const NAME = 'canny_retrieve_idea'; protected const DESCRIPTION = 'Retrieve a Canny idea by ID.'; protected const OPERATION = 'retrieve_idea'; protected const REQUIRED = ['id']; }
