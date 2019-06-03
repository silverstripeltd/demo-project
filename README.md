## Overview

This repository contains a SilverStripe project used to demo on SilverStripe Cloud Platform.

This branch is `master` - used as the initial deployment and starting point for the demo.  

The other branches below are used to demonstrate changes in the CMS, introduce bugs and action deployments on the platform.  

* `add-articlepage-fields branch` - Adds Date, Teaser and Author fields to the article page. 
* `remove-article-page-fields` - Removes all custom fields including Categories and Attachment tabs on the article page.  
* `bug-in-dev-build` - Injects a deliberate bug in the dev/build
* `request-debugger` - Adds a simple request debugging script
* `add_cron_to_platform` - Configures the `.platform.yml` file to add cron tasks to the stack.

## Updates to the Project ## 
Please create a pull request for each branch to apply any update/fixes. 
 
Any updates that are not part of the demo (eg framework upgrades) will have to be applied into to all branches listed above for consistency. 

## Installation ##

See [installation on different platforms](http://doc.silverstripe.org/framework/en/installation/),
and [installation from source](http://doc.silverstripe.org/framework/en/installation/from-source).

## Bugtracker ##

Bugs are tracked on github.com ([framework issues](https://github.com/silverstripe/silverstripe-framework/issues),
[cms issues](https://github.com/silverstripe/silverstripe-cms/issues)). 
Please read our [issue reporting guidelines](http://doc.silverstripe.org/framework/en/misc/contributing/issues).

## Development and Contribution ##

If you would like to make changes to the SilverStripe core codebase, we have an extensive [guide to contributing code](http://doc.silverstripe.org/framework/en/misc/contributing/code).

## Links ##

 * [Changelogs](http://doc.silverstripe.org/framework/en/changelogs/)
 * [Bugtracker: Framework](https://github.com/silverstripe/silverstripe-framework/issues)
 * [Bugtracker: CMS](https://github.com/silverstripe/silverstripe-cms/issues)
 * [Bugtracker: Installer](https://github.com/silverstripe/silverstripe-installer/issues)
 * [Forums](http://silverstripe.org/forums)
 * [Developer Mailinglist](https://groups.google.com/forum/#!forum/silverstripe-dev)

## License ##

	Copyright (c) 2007-2013, SilverStripe Limited - www.silverstripe.com
	All rights reserved.

	Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:

	    * Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
	    * Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the 
	      documentation and/or other materials provided with the distribution.
	    * Neither the name of SilverStripe nor the names of its contributors may be used to endorse or promote products derived from this software 
	      without specific prior written permission.

	THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE 
	IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE 
	LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE 
	GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, 
	STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY 
	OF SUCH DAMAGE.
