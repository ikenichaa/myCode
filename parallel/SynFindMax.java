

public class SynFindMax implements Runnable { 
	private int start;
	private int end;
	private int[] A;
	
	
		
	public SynFindMax(int[] A, int start, int end) {
		this.start = start;
		this.end = end;
		this.A = A;
		
    }
    
	public void run() {
		
			for (int i=start; i <=end; i++) {
	    		if (SynMax.max<A[i]){
	    			synchronized (SynMax.lock){
	    				SynMax.max = A[i];
	    			}
	    			
	    		}
			
			}		
    }

}




    

