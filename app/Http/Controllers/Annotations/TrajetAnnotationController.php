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

 * @OA\GET(
 *     path="/api/trajets/{id}",
 *     summary="voir  détail trajet",
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
 *     tags={"Trajet"},
*),


 * @OA\PUT(
 *     path="/api/trajets/{id}",
 *     summary="Modifier trajet",
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
 *                     @OA\Property(property="conducteur_id", type="integer"),
 *                     @OA\Property(property="point_depart", type="string"),
 *                     @OA\Property(property="point_arrivee", type="string"),
 *                     @OA\Property(property="date_heure_depart", type="string"),
 *                     @OA\Property(property="statut", type="string"),
 *                     @OA\Property(property="vehicule_id", type="integer"),
 *                     @OA\Property(property="prix", type="integer"),
 *                 },
 *             ),
 *         ),
 *     ),
 *     tags={"Trajet"},
*),


 * @OA\DELETE(
 *     path="/api/trajets",
 *     summary="detele trajet",
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
 *     tags={"Trajet"},
*),


 * @OA\POST(
 *     path="/api/trajets",
 *     summary="Proposer trajet",
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
 *                     @OA\Property(property="conducteur_id", type="integer"),
 *                     @OA\Property(property="point_depart", type="string"),
 *                     @OA\Property(property="point_arrivee", type="string"),
 *                     @OA\Property(property="date_heure_depart", type="string"),
 *                     @OA\Property(property="statut", type="string"),
 *                     @OA\Property(property="vehicule_id", type="integer"),
 *                     @OA\Property(property="prix", type="integer"),
 *                 },
 *             ),
 *         ),
 *     ),
 *     tags={"Trajet"},
*),


 * @OA\GET(
 *     path="/api/trajets",
 *     summary="Liste trajet",
 *     description="",
 *         security={
 *    {       "BearerAuth": {}}
 *         },
 * @OA\Response(response="200", description="OK"),
 * @OA\Response(response="404", description="Not Found"),
 * @OA\Response(response="500", description="Internal Server Error"),
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * ),
 *     tags={"Trajet"},
*),


*/

 class TrajetAnnotationController {}
