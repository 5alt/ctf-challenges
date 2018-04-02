#include <stdio.h>
#include <stdlib.h>

int main() {

    FILE *f;
    char c;
    f=fopen("/flag","rt");

    while((c=fgetc(f))!=EOF){
        printf("%c",c);
    }

    fclose(f);
    return 0;
}
