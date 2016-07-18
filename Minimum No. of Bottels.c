#include<stdio.h>
#include<string.h>
#include<limits.h>

int main()
{


    int t,n,m,i,j;
    scanf("%d",&t);
    int min[10005];
    memset(min,20000,sizeof(min));
      min[0]=0;
    ///for(i=0;i<10;i++)printf("%d ",min[i]);
    int value[]={1,5,7,10};

    for(i=1;i<1001;i++)
    {
        for(j=0;j<4;j++)
    {
        if(i>=value[j]  && min[i]>1+min[i-value[j]])
        {
            min[i]=min[i-value[j]]+1;


        }

    }


    }

    while(t--)
    {

    scanf("%d",&n);
    printf("%d",min[n]);

        if(t>=1)printf("\n");
    }

    return 0;
}
