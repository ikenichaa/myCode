import java.util.Arrays;

public class AddArray {
	public static int NUM_TASKS = 4;
	public static int NUM_DATA = 1000;
	public static void main(String[] args) throws Exception {
	      int[] A = new int[NUM_DATA];
	      int[] B = new int[NUM_DATA];
	      int[] C = new int[NUM_DATA];
	      for (int i=0; i < A.length; i++){
	    	A[i] = i;
	      	B[i] = i;
	      }
	      int chunkSize = A.length/NUM_TASKS; 
	      Add[] tasks = new Add[NUM_TASKS]; 
	      Thread[] threads = new Thread[NUM_TASKS];
	      
	      for (int i=0; i < NUM_TASKS; i++) {
	    	  int start = chunkSize*i;
	    	  int end = chunkSize*(i+1) - 1; 
	    	  tasks[i] = new Add(A,B,start,end); 
	    	  threads[i] = new Thread(tasks[i]); 
	    	  threads[i].start();
	      }
	      
	      for (int i=0; i < NUM_TASKS; i++) {
	    	   threads[i].join();
	    	}
	      
	      for (int i=0; i < NUM_TASKS; i++) {
	    	  for (int j=0; j < NUM_DATA; j++){
	    		  C[j] = C[j]^tasks[i].getArray()[j];
	    	  }
	    	}

	    	System.out.println(Arrays.toString(C));
	      }
}




