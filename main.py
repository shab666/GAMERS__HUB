import pygame
import random


pygame.init()

#Fenetre principale
LARGEUR,HAUTEUR = 600, 400
ecran = pygame.display.set_mode((LARGEUR, HAUTEUR))
pygame.display.set_caption("Carré Dodge")

#Couleur
NOIR=(0,0,0)
BLEU=(0,150,255)
ROUGE=(255,0,0)

#Joueur
joueur = pygame.Rect(280, 350, 40, 40)
vitesse_joueur = 5

# ennemi
ennemi = pygame.Rect(random.randint(0, LARGEUR - 40), 0, 40, 40)
vitesse_ennemi = 4

clock = pygame.time.Clock()
score = 0
font = pygame.font.SysFont(None, 30)

running = True
while running:
    clock.tick(60)
    ecran.fill(NOIR)

    for event in pygame.event.get():
        if event.type == pygame.QUIT:
            running = False

    # Controle
    touches = pygame.key.get_pressed()
    if touches[pygame.K_LEFT] and joueur.x > 0:
        joueur.x -= vitesse_joueur
    if touches[pygame.K_RIGHT] and joueur.x < LARGEUR - joueur.width:
        joueur.x += vitesse_joueur

    # Ennemi descend
    ennemi.y += vitesse_ennemi
    if ennemi.y > HAUTEUR:
        ennemi.y = 0
        ennemi.x = random.randint(0, LARGEUR - ennemi.width)
        score += 1
        vitesse_ennemi += 0.2

    # Collision
    if joueur.colliderect(ennemi):
        running = False

    # Dessin
    pygame.draw.rect(ecran, BLEU, joueur)
    pygame.draw.rect(ecran, ROUGE, ennemi)

    texte = font.render(f"Score: {score}", True, (255, 255, 255))
    ecran.blit(texte, (10, 10))

    pygame.display.flip()

pygame.quit()