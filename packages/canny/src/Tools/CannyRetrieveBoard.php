<?php
namespace OpenCompany\Integrations\Canny\Tools;
/** Retrieve a Canny board by ID. */
class CannyRetrieveBoard extends AbstractCannyTool { protected const NAME = 'canny_retrieve_board'; protected const DESCRIPTION = 'Retrieve a Canny board by ID.'; protected const OPERATION = 'retrieve_board'; protected const REQUIRED = ['id']; }
