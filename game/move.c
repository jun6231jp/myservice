#include <stdio.h>
#include <stdlib.h>
#include <string.h>

int ban[81];
int oki[40];
int teban;

void oki_sort (void)
{
  int temp = 0;
  if (teban==0)
    {
      for (int i = 0 ; i < 19 ; i++)
        {
          for (int j = 0 ; j < 19 ; j++)
            {
              if(oki[j] < oki[j+1])
                {
                  temp = oki[j];
                  oki[j] = oki[j+1];
                  oki[j+1]=temp;
                }
            }
        }
    }
  else
    {
      for (int i = 0 ; i < 19 ; i++)
        {
          for (int j = 20 ; j < 39 ; j++)
            {
              if(oki[j] < oki[j+1])
                {
                  temp = oki[j];
                  oki[j] = oki[j+1];
                  oki[j+1]=temp;
                }
            }
        }
    }
}
void tori (int x , int y)
{
  if (teban==0)
    {
      if(ban[y]<23)
        {
          oki[19]=ban[y] - 14;
        }
      else if (ban[y]<27)
        {
          oki[19]=ban[y] - 22;
        }
      else
        {
          oki[19]=ban[y] - 21;
        }
    }
  else
    {
      if(ban[y]<9)
        {
          oki[39]=ban[y] + 14;
        }
      else if (ban[y]<13)
        {
          oki[39]=ban[y] + 6;
        }
      else
        {
          oki[39]=ban[y] + 7;
        }
    }
  ban[y]=ban[x];
  ban[x]=0;
  oki_sort();
}
void nari (int x,int y)
{
  if(ban[y]!=5 && ban[y]!=8 && ban[y]!=19 && ban[y]!=22)
    {
      if (teban==1 && y > 53)
        {
          if(ban[y] < 20 && ban[y] > 14)
            {
              ban[y]=ban[y] + 8;
            }
          else if (ban[y] == 20 || ban[y] == 21)
            {
              ban[y]=ban[y] + 7;
            }
        }
      else if (teban==0 && y < 27)
        {
          if(ban[y] < 6)
            {
              ban[y]=ban[y] + 8;
            }
          else if (ban[y] == 6 || ban[y] == 7)
            {
              ban[y]=ban[y] + 7;
            }
        }
   else if (teban==1 && x > 53 && x < 81)
        {
          if(ban[y] < 20 && ban[y] > 14)
            {
              ban[y]=ban[y] + 8;
            }
          else if (ban[y] == 20 || ban[y] == 21)
            {
              ban[y]=ban[y] + 7;
            }
        }
      else if (teban==0 && x < 27)
        {
          if(ban[y] < 6)
            {
              ban[y]=ban[y] + 8;
            }
          else if (ban[y] == 6 || ban[y] == 7)
            {
              ban[y]=ban[y] + 7;
            }
        }
    }
}
int uchi (int x , int y)
{
  if (oki[x-81] == 1)
    {
      for (int i = 0 ; i < 9 ; i++)
        {
          if (ban[(y % 9) + (i * 9)] == 1)
            {
              return 1;
            }
        }
     }
  if (oki[x-81] == 1 || oki[x-81] == 2)
    {
      if(y < 9)
        {
          return 1;
        }
    }
  if (oki[x-81] == 3)
    {
      if(y < 18)
        {
          return 1;
        }
    }
  if (oki[x-81] == 15)
    {
      for (int i = 0 ; i < 9 ; i++)
        {
          if (ban[(y % 9) + (i * 9)] == 15)
            {
              return 1;
            }
        }
    }
  if (oki[x-81] == 15 || oki[x-81] == 16)
    {
      if(y > 71)
        {
          return 1;
        }
    }
  if (oki[x-81] == 17)
    {
      if(y > 62)
        {
          return 1;
        }
    }
  ban[y]=oki[x-81];
  oki[x-81]=0;
  oki_sort();
  return 0;
}
void sashi (int x , int y , int narazu)
{
  if(ban[y]==0)
    {
      ban[y]=ban[x];
      ban[x]=0;
      if (narazu == 1) 
        {
           nari(x,y);
        }
    }
  else
    {
      tori(x,y);
      if (narazu == 1)
        {
           nari(x,y);
        }
    }
}
int forbid (int x , int y)
{
  if (x < 81)
    {
      if (ban[x] < 15 && ban[y] < 15 && ban[y] != 0)
        {
          return 1;
        }
      if (ban[x] > 14 && ban[y] > 14)
        {
          return 1;
        }
        
        if (ban[x] == 0)
        {
          return 1;
        }
      if (teban==0 && ban[x] > 14)
        {
          return 1;
        }
      if (teban==1 && ban[x] < 15)
        {
          return 1;
        }
    }
  else
    {
      if (ban[y] != 0)
        {
          return 1;
        }
    }
  return 0;
}

int movechk (int x , int y)
{
if (x > 80 && y > 80)
{
return 1;
}
  if (x < 81)
    {
      if(ban[x]==1)
	{
	  if (y != x-9)
	    { 
	      return 1;
	    }
	}
      if(ban[x]==2)
	{
	  if (y%9 != x%9 || y > x)
	    {
	      return 1;
	    }
	  else
	    {
	      for (int i = 1 ; i < (y-x)/9 - 1  ; i++)
		{
		  if (ban[y + (i * 9)] != 0)
		    {
		      return 1;
		    }
		}
	    }
	}
      if(ban[x]==3)
        {
          if (y != x-19 && y != x-17)
            {
              return 1;
            }
        }
      if(ban[x]==4)
        {
          if (y != x-9 && y != x-8 && y != x-10 && y != x + 10 && y != x + 8)
            {
              return 1;
            }
        }
      if(ban[x]==5 || ban[x]==9 || ban[x]==10 || ban[x]==11 || ban[x]==12)
        {
          if (y != x-9 && y != x-8 && y != x-10 && y != x + 1 && y != x - 1 && y != x + 9)
            {
              return 1;
            }
        }
      if(ban[x]==6 || ban[x]==20)
        {
          if ((y - x) % 10 != 0 && (y - x) % 8 != 0)
            {
              return 1;
            }
        }
      if(ban[x]==7 || ban[x]==21)
        {
          if ((y - x) % 9 != 0 && (y/9) != (x/9))
            {
              return 1;
            }
        }
      if(ban[x]==8 || ban[x]==22)
        {
          if (y != x-9 && y != x-8 && y != x-10 && y != x + 1 && y != x - 1 && y != x + 9 && y != x + 10 && y != x + 8)
            {
              return 1;
            }
        }
      if(ban[x]==13 || ban[x]==27)
        {
          if ((y - x) % 10 != 0 && (y - x) % 8 != 0 && y != x - 9 && y != x - 1 && y != x + 1 && y != x + 9)
            {
              return 1;
            }
        }
      if(ban[x]==14 || ban[x]==28)
        {
          if ((y - x) % 9 != 0 && (y/9) != (x/9) && y != x - 8 && y != x - 10 && y != x + 8 && y != x + 10)
            {
              return 1;
            }
        }


      if(ban[x]==15)
        {
          if (y != x+9)
            {
              return 1;
            }
        }
      if(ban[x]==16)
        {
          if (y%9 != x%9 || y < x)
            {
              return 1;
            }
          else
            {
              for (int i = 1 ; i < (x-y)/9 - 1  ; i++)
                {
                  if (ban[y - (i * 9)] != 0)
                    {
                      return 1;
                    }
                }
            }
        }
      if(ban[x]==17)
        {
          if (y != x+19 && y != x+17)
            {
              return 1;
            }
        }
      if(ban[x]==18)
        {
          if (y != x+9 && y != x+8 && y != x+10 && y != x - 10 && y != x - 8)
            {
              return 1;
            }
        }
      if(ban[x]==19 || ban[x]==23 || ban[x]==24 || ban[x]==25 || ban[x]==26)
        {
          if (y != x+9 && y != x+8 && y != x+10 && y != x - 1 && y != x + 1 && y != x - 9)
            {
              return 1;
            }
        }
    }
  return 0;
}

void judge (void)
{

}

int main (int argc , char* argv[])
{
  /*
  argv[1-81]:ban
  argv[82-101]:oki1
  argv[102-121]:oki2
  argv[122]:before
  argv[123]:after
  argv[124]:teban
  argv[125]:nari
  R:14
  U:13
  Ng:12
  Nke:11
  Nky:10
  T:9
  O:8
  h:7
  ka:6
  ki:5
  g:4
  ke:3
  ky:2
  f:1
 */
   int x,y,narazu,res;

  //para
  for (int i = 0 ; i < 81 ; i++)
    {
      ban[i]=atoi(argv[i+1]);
    }
  for (int i = 0 ; i < 40 ; i++)
    {
      oki[i]=atoi(argv[i+82]);
    }
  teban=atoi(argv[124]);
  x=atoi(argv[122]);
  y=atoi(argv[123]);
  narazu=atoi(argv[125]);

  //exe
  res = forbid(x,y);
  if(res == 1)
    {
      return 1;
    }
  res = movechk(x,y);
  if(res == 1)
    {
      return 1;
    }
  if (x > 80)
    {
      res=uchi(x,y);
      if(res == 1)
        {
          return 1;
        }
    }        
 else
    {
      sashi(x,y,narazu);
    }
  //show
  for (int i = 0 ; i < 9 ; i++)
    {
      for (int j = 0 ; j < 9 ; j++)
        {
          if(ban[(i*9)+j] < 10)
            {
              printf("0%d",ban[(i*9)+j]);
            }
          else
            {
              printf("%d",ban[(i*9)+j]);
            }
        }
    }
  for (int i = 0 ; i < 2; i++)
    {
      for (int j = 0 ; j < 20; j++)
        {
          if(oki[(i*20)+j] < 10)
            {
              printf("0%d",oki[(i*20)+j]);
            }
          else
            {
              printf("%d",oki[(i*20)+j]);
            }
        }
    }
  return 0;
}
