
public class SynMax {
	public static int NUM_TASKS = 4;
	public static int NUM_DATA = 1000000;
	public static int max=0;
	public static Object lock = new Object();
	
	public static void main(String[] args) throws Exception {
		long st = System.currentTimeMillis();
	      int[] A = new int[NUM_DATA];
	      
	      for (int i=0; i < A.length; i++){
	    	A[i] = i;
	      }
	      
	      int chunkSize = A.length/NUM_TASKS; 
	      SynFindMax[] tasks = new SynFindMax[NUM_TASKS]; 
	      Thread[] threads = new Thread[NUM_TASKS];
	      
	      for (int i=0; i < NUM_TASKS; i++) {
	    	  int start = chunkSize*i;
	    	  int end = chunkSize*(i+1) - 1; 
	    	  tasks[i] = new SynFindMax(A,start,end); 
	    	  threads[i] = new Thread(tasks[i]); 
	    	  threads[i].start();
	      }
	      
	      for (int i=0; i < NUM_TASKS; i++) {
	    	   threads[i].join();
	    	}
	      
	      
	      
	      long et = System.currentTimeMillis(); 
	      System.out.println(max);
	      //System.out.println(Arrays.toString(A));
	      System.out.println("Execution time: " + (et-st) + " ms.");	    	
	      }
}











