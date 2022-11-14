<?php

namespace App\Http\Controllers;

use App\Http\Resources\SecretResource;
use App\Models\Secret;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\SecretStoreRequest;
use Symfony\Component\HttpFoundation\Response;
use Mtownsend\ResponseXml\Providers\ResponseXmlServiceProvider;


class SecretController extends Controller
{
    //
    public function store(Request $request){
        $newSecret = Secret::create([
            'hash'              => Str::uuid(),
            'secretText'        => $request->secretText,
            'expiresAt'         => $request->expiresAt,
            'remainingViews'    => $request->remainingViews
        ]);

        return $this->getResponse($request, $newSecret, Response::HTTP_CREATED);

    }

    public function show(Request $request, $hash){

        $secret = Secret::findSecretByHash($hash);

        if ($secret){
            $secret->decrementViews();

            return $this->getResponse($request, $secret);
        }
            return response()->preferredFormat([
            'message' => 'Secret not found'], 404);

    }


    public function getResponse($request, $secret, $status = 200){

        $response = match ($request->header('accept')) {
            'application/xml' => response()->preferredFormat($secret, $status, [], class_basename($secret)),
            'application/json' => response(new SecretResource($secret), $status),
            default => new SecretResource($secret),
        };

        return $response;
    }
}

