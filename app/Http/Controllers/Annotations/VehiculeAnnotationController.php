<?php

namespace App\Http\Controllers\Annotations ;

/**
 * @OA\Security(
 *     security={
 *         "BearerAuth": {}
 *     }),

 * @OA\SecurityScheme(
 *     securityScheme="BearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"),

 * @OA\Info(
 *     title="Your API Title",
 *     description="Your API Description",
 *     version="1.0.0"),

 * @OA\Consumes({
 *     "multipart/form-data"
 * }),

 *

 * @OA\DELETE(
 *     path="/api/vehicules/1",
 *     summary="detele vehicule",
 *     description="",
 *         security={
 *    {       "BearerAuth": {}}
 *         },
 * @OA\Response(response="204", description="Deleted successfully"),
 * @OA\Response(response="401", description="Unauthorized"),
 * @OA\Response(response="403", description="Forbidden"),
 * @OA\Response(response="404", description="Not Found"),
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * ),
 *     tags={"Vehicule"},
*),


 * @OA\PUT(
 *     path="/api/vehicules/{id}",
 *     summary="update vehicule",
 *     description="",
 *         security={
 *    {       "BearerAuth": {}}
 *         },
 * @OA\Response(response="200", description="OK"),
 * @OA\Response(response="404", description="Not Found"),
 * @OA\Response(response="500", description="Internal Server Error"),
 *     @OA\Parameter(in="path", name="id", required=false, @OA\Schema(type="string")
 * ),
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/x-www-form-urlencoded",
 *             @OA\Schema(
 *                 type="object",
 *                 properties={
 *                     @OA\Property(property="marque", type="string"),
 *                     @OA\Property(property="modele", type="string"),
 *                     @OA\Property(property="couleur", type="string"),
 *                     @OA\Property(property="immatriculation", type="string"),
 *                     @OA\Property(property="conducteur_id", type="integer"),
 *                     @OA\Property(property="nombre_place", type="integer"),
 *                     @OA\Property(property="assurance_vehicule", type="string"),
 *                     @OA\Property(property="photo", type="string", format="binary"),
 *                 },
 *             ),
 *         ),
 *     ),
 *     tags={"Vehicule"},
*),


 * @OA\GET(
 *     path="/api/vehicules",
 *     summary="Liste vehicule",
 *     description="",
 *         security={
 *    {       "BearerAuth": {}}
 *         },
 * @OA\Response(response="200", description="OK"),
 * @OA\Response(response="404", description="Not Found"),
 * @OA\Response(response="500", description="Internal Server Error"),
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * ),
 *     tags={"Vehicule"},
*),


 * @OA\POST(
 *     path="/api/vehicules",
 *     summary="Ajouter vehicule",
 *     description="",
 *         security={
 *    {       "BearerAuth": {}}
 *         },
 * @OA\Response(response="201", description="Created successfully"),
 * @OA\Response(response="400", description="Bad Request"),
 * @OA\Response(response="401", description="Unauthorized"),
 * @OA\Response(response="403", description="Forbidden"),
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="multipart/form-data",
 *             @OA\Schema(
 *                 type="object",
 *                 properties={
 *                     @OA\Property(property="marque", type="string"),
 *                     @OA\Property(property="modele", type="string"),
 *                     @OA\Property(property="couleur", type="string"),
 *                     @OA\Property(property="immatriculation", type="string"),
 *                     @OA\Property(property="conducteur_id", type="integer"),
 *                     @OA\Property(property="nombre_place", type="integer"),
 *                     @OA\Property(property="assurance_vehicule", type="string"),
 *                     @OA\Property(property="photo", type="string", format="binary"),
 *                 },
 *             ),
 *         ),
 *     ),
 *     tags={"Vehicule"},
*),


*/

 class VehiculeAnnotationController {}
