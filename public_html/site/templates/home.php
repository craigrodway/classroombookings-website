<?php
namespace ProcessWire;

region('breadcrumbs', false);

region('content', wireRenderFile('views/home/hero'));
region('content+', wireRenderFile('views/home/testimonials'));
region('content+', wireRenderFile('views/home/benefits'));
