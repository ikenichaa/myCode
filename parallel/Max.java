public class Max {
	public static int NUM_TASKS = 4;
	public static int NUM_DATA = 1000000;
	public static int max=0;
	public static void main(String[] args) throws Exception {
		long st = System.currentTimeMillis();
	      int[] A = new int[NUM_DATA];
	      
	      for (int i=0; i < A.length; i++){
	    	A[i] = i;
	      }
	      
	      int chunkSize = A.length/NUM_TASKS; 
	      FindMax[] tasks = new FindMax[NUM_TASKS]; 
	      Thread[] threads = new Thread[NUM_TASKS];
	      
	      for (int i=0; i < NUM_TASKS; i++) {
	    	  int start = chunkSize*i;
	    	  int end = chunkSize*(i+1) - 1; 
	    	  tasks[i] = new FindMax(A,start,end); 
	    	  threads[i] = new Thread(tasks[i]); 
	    	  threads[i].start();
	      }
	      
	      for (int i=0; i < NUM_TASKS; i++) {
	    	   threads[i].join();
	    	}
	      int value;
	      
	      for (int i=0; i < NUM_TASKS; i++) {
	    	  value = tasks[i].getMax();
	    	   if (value>max){
	    		   max= value;
	    	   }    		   
	    	}
	      long et = System.currentTimeMillis(); 
	      System.out.println(max);
	      System.out.println("Execution time: " + (et-st) + " ms.");	    	
	      }
}












