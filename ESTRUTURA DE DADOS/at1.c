#include <stdio.h>
#include <stdlib.h>


int main(){
    int a,b,c;
    printf("Digite o numeros a: ");
    scanf("%d", &a);
    printf("Digite o numeros b: ");
    scanf("%d", &b);

    for (c =a;c<=b;c++){
        
        printf("%d \n", c);
    }
    system("pause");
    return 0;
}