#include<stdio.h>
//int r[]={-1};
#include<limits.h>

int max(int a,int b)
{
return (a>b?a:b);}
int rodp(int p[],int n)
{
    int i;
    if(n==0)return 0;
    int r[1000];
    for(i=0;i<=n;i++)
    {
        r[i]=INT_MIN;
    }
return rod(p,n,r);
}
int rod(int p[],int n,int *r)
{int q;
if(r[n]>=0)
return r[n];
if(n==0)
//return 0;
q=0;

else
 q=-123;

int i;
for(i=1;i<=n;i++)
{
q=max(q,p[i]+rod(p,n-i,r));

}
r[n]=q;
return r[n];
}
int main()
{
//
int n;
scanf("%d",&n);
int p[]={0,1,5,8,9,10,17,17,20,24,30};
printf("%d\n",rodp(p,n));
return 0;
}
