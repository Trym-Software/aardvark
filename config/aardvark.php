<?php

app()->instance('config', new \Aardvark\DeferredRepository(app('config')->all()));

return [];
