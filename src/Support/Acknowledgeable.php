<?php

namespace Uro\TeltonikaFmParser\Support;

interface Acknowledgeable 
{
    public function getNumberOfAcceptedData(): int;
}