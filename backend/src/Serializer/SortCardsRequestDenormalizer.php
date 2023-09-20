<?php

namespace App\Serializer;

use App\Dto\Card\SortCardsRequest;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class SortCardsRequestDenormalizer implements DenormalizerInterface
{
    public function denormalize($data, $type, $format = null, array $context = [])
    {
        return new SortCardsRequest($data['cards'], $data['orderTypes'], $data['orderValues']);
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === SortCardsRequest::class;
    }
}