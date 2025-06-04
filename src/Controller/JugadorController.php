<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\JugadorRepository;
use App\Entity\Jugador;
use App\OptionsResolver\JugadorOptionsResolver;
use Doctrine\ORM\EntityManager;
use Exception;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route("/api", "api_")]
class JugadorController extends AbstractController
{
    #[Route('/jugador', name: 'jugador', methods: ["GET"])]
    public function index(JugadorRepository $jugadorRepository): JsonResponse
    {
        $jugador = $jugadorRepository->findAll();
        return $this->json($jugador);
    }

    #[Route("/jugador/{id}", "get_jugador", methods: ["GET"])]
    public function getTodo(Jugador $jugador): JsonResponse
    {
        return $this->json($jugador);
    }
    #[Route("/jugador", "create_jugador", methods: ["POST"])]
    public function createJugador(Request $request, JugadorRepository $jugadorRepository, ValidatorInterface $validator, JugadorOptionsResolver $jugadorOptionsResolver): JsonResponse
    {
        try {
            $requestBody = json_decode($request->getContent(), true);
            $fields = $jugadorOptionsResolver
                ->configureNombre(true)
                ->configureAltura(true)
                ->configureDorsal(true)
                ->resolve($requestBody);

            $jugador = new Jugador();
            $jugador->setNombre($fields["nombre"]);
            $jugador->setAltura($fields["altura"]);
            $jugador->setDorsal($fields["dorsal"]);


            $errors = $validator->validate($jugador);
            if (count($errors) > 0) {
                throw new BadRequestHttpException((string) $errors);
            }

            $jugadorRepository->save($jugador, true);
            return $this->json($jugador, status: Response::HTTP_CREATED);
        } catch (Exception $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
    }
    #[Route("/jugador/{id}", "delete_todo", methods: ["DELETE"])]
    public function deleteTodo(Jugador $jugador, JugadorRepository $jugadorRepository)
    {
        $jugadorRepository->remove($jugador, true);

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }

    #[Route("/jugador/{id}", "update_jugador", methods: ["PATCH", "PUT"])]
    public function updateJugador(Jugador $jugador, Request $request, JugadorOptionsResolver $jugadorOptionsResolver, ValidatorInterface $validator, EntityManager $em)
    {
        try {
            $requestBody = json_decode($request->getContent(), true);
            $isPutMethod = $request->getMethod() === "PUT";

            $fields = $jugadorOptionsResolver
                ->configureNombre($isPutMethod)
                ->configureAltura($isPutMethod)
                ->configureDorsal($isPutMethod)
                ->resolve($requestBody);

            foreach ($fields as $field => $value) {
                switch ($field) {
                    case "nombre":
                        $jugador->setNombre($value);
                        break;
                    case "altura":
                        $jugador->setAltura($value);
                        break;
                    case "dorsal":
                        $jugador->setDorsal($value);
                        break;
                }
            }
            $errors = $validator->validate($jugador);
            if (count($errors) > 0) {
                throw new InvalidArgumentException((string) $errors);
            }

            $em->flush();

            return $this->json($jugador);
        } catch (Exception $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
    }
}
