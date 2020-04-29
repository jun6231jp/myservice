#include <stdio.h>
#include <math.h>
#include <stdlib.h>
#include <string.h>
#include <time.h>
#include <sys/time.h>

int main (int argc , char* argv[]) {
 struct timeval startTime, endTime;
 clock_t startClock, endClock;
 int now=0;
 int Rand=0;
 int rem=0;
 int* dis;
 int diff=0;
 time_t diffsec=0;
 suseconds_t diffsub=0;
 int x=atoi(argv[1]);
 int y=atoi(argv[2]);
 int rep=atoi(argv[3]);
 int size=x*y;
 int sum=0;
 dis = (int*)malloc(sizeof(int) * size);
 for (int i=0; i<rep ; i++){
   gettimeofday(&startTime, NULL);
   startClock = clock();
   now=(int)startTime.tv_sec+(int)startTime.tv_usec;
   srand(now);
   Rand=rand();
   rem=Rand%size;
   if(dis[rem]==0){
     dis[rem]++;
   }
   else{
     i--;
   }
   while(diff == ((int)diffsub + (int)diffsec)){
     gettimeofday(&endTime, NULL);
     endClock = clock();
     diffsec = difftime(endTime.tv_sec, startTime.tv_sec);
     diffsub =endTime.tv_usec - startTime.tv_usec;
   }
   diff = (int)diffsub + (int)diffsec;
   now = now + diff;
 }
for (int j=0;j<y;j++){
   for (int k=0; k<x; k++){
     if (dis[(j*x)+k] != 0){
       printf("9");
     }
     else{
       if(j==0 && k==(x-1)){
         sum=dis[(j*x)+k-1]+dis[(j+1)*x+k]+dis[(j+1)*x+k-1];
       }
       else if (j==0 && k==0){
         sum=dis[(j*x)+k+1]+dis[(j+1)*x+k]+dis[(j+1)*x+k+1];
       }
       else if (j==(y-1) && k==(x-1)){
         sum=dis[(j*x)+k-1]+dis[(j-1)*x+k]+dis[(j-1)*x+k-1];
       }
       else if (j==(y-1) && k==0){
         sum=dis[(j*x)+k+1]+dis[(j-1)*x+k]+dis[(j-1)*x+k+1];
       }
       else if(j==0){
         sum=dis[(j*x)+k-1]+dis[(j*x)+k+1]+dis[(j+1)*x+k]+dis[(j+1)*x+k-1]+dis[(j+1)*x+k+1];
       }
       else if (j==(y-1)){
         sum=dis[(j*x)+k-1]+dis[(j*x)+k+1]+dis[(j-1)*x+k]+dis[(j-1)*x+k-1]+dis[(j-1)*x+k+1];
       }
       else if (k==(x-1)){
         sum=dis[(j*x)+k-1]+dis[(j+1)*x+k]+dis[(j-1)*x+k]+dis[(j+1)*x+k-1]+dis[(j-1)*x+k-1];
       }
       else if (k==0){
         sum=dis[(j*x)+k+1]+dis[(j+1)*x+k]+dis[(j-1)*x+k]+dis[(j+1)*x+k+1]+dis[(j-1)*x+k+1];
       }
       else{
         sum=dis[(j*x)+k+1]+dis[(j*x)+k-1]+dis[(j+1)*x+k]+dis[(j-1)*x+k]+dis[(j+1)*x+k+1]+dis[(j+1)*x+k-1]+dis[(j-1)*x+k+1]+dis[(j-1)*x+k-1];
       }
       printf("%d",sum);
     }
   }
 }
 free(dis);
 return 0;
}
