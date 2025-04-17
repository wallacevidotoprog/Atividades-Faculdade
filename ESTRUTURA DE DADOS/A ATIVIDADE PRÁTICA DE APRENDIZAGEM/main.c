#include <stdio.h>
#include <stdlib.h>
#include <string.h>

#define MAX_TITULO 100
#define MAX_AUTOR 50

typedef struct {
    int id;
    char titulo[MAX_TITULO];
    char autor[MAX_AUTOR];
    int ano;
} Livro;

typedef struct No {
    Livro livro;
    struct No *proximo;
} No;

No* adicionarLivro(No *inicio) {
    No *novo = (No*)malloc(sizeof(No));
    
    printf("ID do livro: ");
    scanf("%d", &novo->livro.id);
    getchar(); 
    
    printf("Título: ");
    fgets(novo->livro.titulo, MAX_TITULO, stdin);
    novo->livro.titulo[strcspn(novo->livro.titulo, "\n")] = '\0'; 
    
    printf("Autor: ");
    fgets(novo->livro.autor, MAX_AUTOR, stdin);
    novo->livro.autor[strcspn(novo->livro.autor, "\n")] = '\0';
    
    printf("Ano: ");
    scanf("%d", &novo->livro.ano);
    getchar();
    
    novo->proximo = inicio;
    printf("Livro adicionado com sucesso!\n");
    
    return novo;
}

No* removerLivro(No *inicio, int id) {
    No *anterior = NULL;
    No *atual = inicio;
    
    while (atual != NULL) {
        if (atual->livro.id == id) {
            if (anterior == NULL) {
               
                inicio = atual->proximo;
            } else {
                anterior->proximo = atual->proximo;
            }
            
            printf("Livro '%s' removido para doação.\n", atual->livro.titulo);
            free(atual);
            return inicio;
        }
        anterior = atual;
        atual = atual->proximo;
    }
    
    printf("Livro com ID %d não encontrado.\n", id);
    return inicio;
}

void listarLivros(No *inicio) {
    printf("\n--- LISTA DE LIVROS ---\n");
    No *atual = inicio;
    
    if (atual == NULL) {
        printf("Nenhum livro na coleção.\n");
    }
    
    while (atual != NULL) {
        printf("ID: %d\n", atual->livro.id);
        printf("Título: %s\n", atual->livro.titulo);
        printf("Autor: %s\n", atual->livro.autor);
        printf("Ano: %d\n\n", atual->livro.ano);
        atual = atual->proximo;
    }
    printf("----------------------\n");
}


int main() {
    No *colecao = NULL;
    int opcao, id;
    
    do {
        printf("\n--- MENU ---\n");
        printf("1. Adicionar livro\n");
        printf("2. Remover livro (doação)\n");
        printf("3. Listar livros\n");
        printf("0. Sair\n");
        printf("Escolha: ");
        scanf("%d", &opcao);
        getchar(); 
        
        switch(opcao) {
            case 1:
                colecao = adicionarLivro(colecao);
                break;
                
            case 2:
                printf("ID do livro a remover: ");
                scanf("%d", &id);
                getchar();
                colecao = removerLivro(colecao, id);
                break;
                
            case 3:
                listarLivros(colecao);
                break;
                
            case 0:
                printf("Saindo...\n");
                break;
                
            default:
                printf("Opção inválida!\n");
        }
    } while (opcao != 0);
    
    
    No *atual = colecao;
    while (atual != NULL) {
        No *temp = atual;
        atual = atual->proximo;
        free(temp);
    }
    
    return 0;
}