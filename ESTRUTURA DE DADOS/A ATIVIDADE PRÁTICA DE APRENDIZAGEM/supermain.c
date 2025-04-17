#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <stdbool.h>

#define MAX_TITULO 100
#define MAX_AUTOR 50


typedef struct {
    int id;
    char titulo[MAX_TITULO];
    char autor[MAX_AUTOR];
    int ano;
} Livro;


typedef struct NoLista {
    Livro livro;
    struct NoLista *proximo;
} NoLista;


typedef struct NoFila {
    Livro livro;
    struct NoFila *proximo;
} NoFila;

typedef struct {
    NoFila *inicio;
    NoFila *fim;
} Fila;


typedef struct NoPilha {
    Livro livro;
    char operacao; 
    struct NoPilha *proximo;
} NoPilha;


NoLista* adicionarLivroLista(NoLista *inicio, Livro livro, NoPilha **topo) {
    NoLista *novo = (NoLista*)malloc(sizeof(NoLista));
    novo->livro = livro;
    novo->proximo = inicio;
    
   
    NoPilha *novoPilha = (NoPilha*)malloc(sizeof(NoPilha));
    novoPilha->livro = livro;
    novoPilha->operacao = 'A';
    novoPilha->proximo = *topo;
    *topo = novoPilha;
    
    return novo;
}

NoLista* removerLivroLista(NoLista *inicio, int id, Fila *filaDoacao, NoPilha **topo) {
    NoLista *anterior = NULL;
    NoLista *atual = inicio;
    
    while (atual != NULL) {
        if (atual->livro.id == id) {
            
            NoFila *novoFila = (NoFila*)malloc(sizeof(NoFila));
            novoFila->livro = atual->livro;
            novoFila->proximo = NULL;
            
            if (filaDoacao->inicio == NULL) {
                filaDoacao->inicio = filaDoacao->fim = novoFila;
            } else {
                filaDoacao->fim->proximo = novoFila;
                filaDoacao->fim = novoFila;
            }
            
            
            NoPilha *novoPilha = (NoPilha*)malloc(sizeof(NoPilha));
            novoPilha->livro = atual->livro;
            novoPilha->operacao = 'R';
            novoPilha->proximo = *topo;
            *topo = novoPilha;
            
           
            if (anterior == NULL) {
                NoLista *temp = atual->proximo;
                free(atual);
                return temp;
            } else {
                anterior->proximo = atual->proximo;
                free(atual);
                return inicio;
            }
        }
        anterior = atual;
        atual = atual->proximo;
    }
    
    printf("Livro com ID %d não encontrado.\n", id);
    return inicio;
}

void listarLivros(NoLista *inicio) {
    printf("\n--- COLEÇÃO DE LIVROS ---\n");
    NoLista *atual = inicio;
    while (atual != NULL) {
        printf("ID: %d | Título: %s | Autor: %s | Ano: %d\n",
               atual->livro.id, atual->livro.titulo, 
               atual->livro.autor, atual->livro.ano);
        atual = atual->proximo;
    }
    printf("------------------------\n");
}

void listarFilaDoacao(Fila *fila) {
    printf("\n--- FILA DE DOAÇÃO ---\n");
    NoFila *atual = fila->inicio;
    while (atual != NULL) {
        printf("ID: %d | Título: %s\n", atual->livro.id, atual->livro.titulo);
        atual = atual->proximo;
    }
    printf("----------------------\n");
}

void doarLivros(Fila *fila) {
    int contador = 0;
    while (fila->inicio != NULL) {
        NoFila *temp = fila->inicio;
        fila->inicio = fila->inicio->proximo;
        free(temp);
        contador++;
    }
    fila->fim = NULL;
    printf("%d livros foram doados com sucesso!\n", contador);
}


void desfazerOperacao(NoLista **inicio, NoPilha **topo, Fila *filaDoacao) {
    if (*topo == NULL) {
        printf("Nada para desfazer!\n");
        return;
    }
    
    NoPilha *temp = *topo;
    *topo = (*topo)->proximo;
    
    if (temp->operacao == 'A') {
        
        NoLista *anterior = NULL;
        NoLista *atual = *inicio;
        
        while (atual != NULL) {
            if (atual->livro.id == temp->livro.id) {
                if (anterior == NULL) {
                    *inicio = atual->proximo;
                } else {
                    anterior->proximo = atual->proximo;
                }
                free(atual);
                printf("Adição do livro '%s' desfeita.\n", temp->livro.titulo);
                break;
            }
            anterior = atual;
            atual = atual->proximo;
        }
    } else if (temp->operacao == 'R') {
        
        NoLista *novo = (NoLista*)malloc(sizeof(NoLista));
        novo->livro = temp->livro;
        novo->proximo = *inicio;
        *inicio = novo;
        
        
        NoFila *anteriorFila = NULL;
        NoFila *atualFila = filaDoacao->inicio;
        
        while (atualFila != NULL) {
            if (atualFila->livro.id == temp->livro.id) {
                if (anteriorFila == NULL) {
                    filaDoacao->inicio = atualFila->proximo;
                } else {
                    anteriorFila->proximo = atualFila->proximo;
                }
                
                if (filaDoacao->fim == atualFila) {
                    filaDoacao->fim = anteriorFila;
                }
                
                free(atualFila);
                break;
            }
            anteriorFila = atualFila;
            atualFila = atualFila->proximo;
        }
        
        printf("Remoção do livro '%s' desfeita.\n", temp->livro.titulo);
    }
    
    free(temp);
}


void lerString(char *destino, int tamanho) {
    fgets(destino, tamanho, stdin);
    destino[strcspn(destino, "\n")] = '\0';
}

int main() {
    NoLista *colecao = NULL;
    Fila filaDoacao = {NULL, NULL};
    NoPilha *pilhaOperacoes = NULL;
    
    int opcao, id, ano;
    Livro livro;
    
    do {
        printf("\n--- GERENCIADOR DE LIVROS ---\n");
        printf("1. Adicionar livro à coleção\n");
        printf("2. Marcar livro para doação\n");
        printf("3. Listar todos os livros\n");
        printf("4. Listar livros na fila de doação\n");
        printf("5. Efetivar doação dos livros\n");
        printf("6. Desfazer última operação\n");
        printf("0. Sair\n");
        printf("Escolha uma opção: ");
        scanf("%d", &opcao);
        getchar(); 
        
        switch(opcao) {
            case 1:
                printf("ID: ");
                scanf("%d", &livro.id);
                getchar();
                
                printf("Título: ");
                lerString(livro.titulo, MAX_TITULO);
                
                printf("Autor: ");
                lerString(livro.autor, MAX_AUTOR);
                
                printf("Ano: ");
                scanf("%d", &livro.ano);
                getchar();
                
                colecao = adicionarLivroLista(colecao, livro, &pilhaOperacoes);
                printf("Livro adicionado com sucesso!\n");
                break;
                
            case 2:
                printf("ID do livro a marcar para doação: ");
                scanf("%d", &id);
                getchar();
                
                colecao = removerLivroLista(colecao, id, &filaDoacao, &pilhaOperacoes);
                break;
                
            case 3:
                listarLivros(colecao);
                break;
                
            case 4:
                listarFilaDoacao(&filaDoacao);
                break;
                
            case 5:
                doarLivros(&filaDoacao);
                break;
                
            case 6:
                desfazerOperacao(&colecao, &pilhaOperacoes, &filaDoacao);
                break;
                
            case 0:
                printf("Saindo...\n");
                break;
                
            default:
                printf("Opção inválida!\n");
        }
    } while (opcao != 0);
    
    while (colecao != NULL) {
        NoLista *temp = colecao;
        colecao = colecao->proximo;
        free(temp);
    }
    
    while (filaDoacao.inicio != NULL) {
        NoFila *temp = filaDoacao.inicio;
        filaDoacao.inicio = filaDoacao.inicio->proximo;
        free(temp);
    }
    
    while (pilhaOperacoes != NULL) {
        NoPilha *temp = pilhaOperacoes;
        pilhaOperacoes = pilhaOperacoes->proximo;
        free(temp);
    }
    
    return 0;
}